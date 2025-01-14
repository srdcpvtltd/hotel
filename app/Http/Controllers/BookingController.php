<?php

namespace App\Http\Controllers;

use App\DataTables\BookingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\AdvanceBooking;
use App\Models\Booking;
use App\Models\BookingRoom;
use App\Models\HotelProfile;
use App\Models\Room;
use App\Models\RoomType;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{


    protected $BookingService;

    public function __construct(BookingService $BookingService)
    {
        $this->BookingService = $BookingService;
    }

    public function index(BookingDataTable $table)
    {
        if (\Auth::user()->can('manage-Booking')) {
            return $table->render('booking.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function create()
    {
        if (\Auth::user()->can('create-Booking')) {
            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }

            $room_types = RoomType::where('hotel_id', $hotel->id)->get();

            return view('booking.create', compact('room_types'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function store(BookingRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $hotel_id = [
            'hotel_id' => $hotel->id,
            'room_status' => 1,
        ];

        $message = '';
        try {
            $BookingService = $this->BookingService->store($request, AdvanceBooking::class, $hotel_id);
            $message = 'Booking saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('booking.index')
            ->with('message', __($message));
    }

    public function edit(AdvanceBooking $booking)
    {
        if (\Auth::user()->can('edit-Booking')) {
            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }

            $room_types = RoomType::where('hotel_id', $hotel->id)->get();

            return view('booking.edit')->with(compact('booking', 'room_types'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function update(BookingRequest $request, AdvanceBooking $booking)
    {
        try {
            $this->BookingService->update($request, $booking);

            $message = 'Booking Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('booking.index')
            ->with('message', __($message));
    }

    public function destroy(BookingRequest $request, AdvanceBooking $booking)
    {
        if (\Auth::user()->can('delete-Booking')) {
            try {
                $this->BookingService->destroy($request, $booking);

                $message = 'Booking Deleted successfully';
            } catch (\Exception $exception) {
                $message = 'Error has Deleted';
            }
            return redirect()->route('booking.index')
                ->with('message', __($message));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function proceed_check_in($id)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $booking = AdvanceBooking::where('id', $id)->first();
        $countries = DB::table('countries')->get();
        $room_types = RoomType::where('hotel_id', $hotel->id)->get();
        $room = Room::where('hotel_id', $hotel->id)->get();

        return view('booking.register', compact('booking', 'countries', 'room_types', 'room', 'id'));
    }

    public function getRoom(Request $request)
    {
        $rooms = Room::where('room_type_id', $request->room_type)->where('status', 0)->get();
        // dd($rooms);
        if (count($rooms) > 0) {
            return response()->json($rooms);
        }
    }

    public function room_booking(Request $request)
    {
        $room_type = RoomType::where('id', $request->room_type)->first();

        $room = Room::where('id', $request->room)->where('status', 0)->first();

        return response()->json([
            'room_type' => $room_type,
            'room' => $room
        ]);
    }

    public function payment(Request $request)
    {
        $payment = Booking::where('id', $request->booking_id)->first();
        $payment->total_amount = $request->total_amount;
        $payment->payment_method = $request->payment_method;
        $payment->payment_status = $request->payment_status;
        $payment->save();

        return redirect()->back();
    }
}
