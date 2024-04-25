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

class BookingController extends Controller
{


    protected $BookingService;

    public function __construct(BookingService $BookingService)
    {
        $this->BookingService = $BookingService;
    }

    public function index(BookingDataTable $table)
    {
        return $table->render('booking.index');
    }

    public function create()
    {
        $room_types = RoomType::all();

        return view('booking.create', compact('room_types'));
    }

    public function store(BookingRequest $request)
    {
        $message = '';
        try {
            $BookingService = $this->BookingService->store($request, AdvanceBooking::class);
            $message = 'Booking saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('booking.index')
            ->with('message', __($message));
    }

    public function edit(AdvanceBooking $booking)
    {
        $room_types = RoomType::all();
        return view('booking.edit')->with(compact('booking', 'room_types'));
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
        try {
            $this->BookingService->destroy($request, $booking);

            $message = 'Booking Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('booking.index')
            ->with('message', __($message));
    }

    public function proceed_check_in($id)
    {
        $booking = AdvanceBooking::find($id)->first();
        $countries = \DB::table('countries')->get();
        $room_types = RoomType::all();
        $room = Room::all();

        return view('booking.register', compact('booking', 'countries', 'room_types', 'room'));
    }

    public function getRoom(Request $request)
    {
        $rooms = Room::where('room_type_id', $request->room_type)->where('status', 0)->get();

        if (count($rooms) > 0) {
            return response()->json($rooms);
        }
    }

    public function room_booking(Request $request)
    {
        // dd($request->all());
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        $room = Room::where('id', $request->room)->first();

        $booking = new Booking();
        $booking->gues_name = $request->gues_name;
        $booking->mobile_number = $request->mobile_number;
        $booking->age = $request->age;
        $booking->user_id = Auth::id();
        $booking->gender = $request->gender;
        $booking->email_id = $request->email_id;
        $booking->hotel_id = $hotel->id;
        $booking->arrival_date = $request->arrival_date;
        $booking->arrival_time = $request->arrival_time;
        $booking->save();

        $book_room = new BookingRoom();
        $book_room->booking_id = $booking->id;
        $book_room->room_number = $room->name;
        $book_room->created_at = date('Y-m-d H:i:s');
        $book_room->save();
    }
}
