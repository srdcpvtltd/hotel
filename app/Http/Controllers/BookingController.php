<?php

namespace App\Http\Controllers;

use App\DataTables\BookingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\AdvanceBooking;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use App\Services\BookingService;
use Illuminate\Http\Request;

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

}
