<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    

    protected $BookingService;

    public function __construct(BookingService $BookingService)
    {
        $this->BookingService = $BookingService;
    }

    public function index(RoomDataTable $table)
    {
        return $table->render('system_management.room.index');
    }

    public function create()
    {
        $room_type = RoomType::all();

        return view('system_management.room.create', compact('room_type'));
    }

    public function store(RoomRequest $request)
    {
        $message = '';
        try {
            $BookingService = $this->BookingService->store($request, Room::class);
            $message = 'Room saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('rooms.index')
            ->with('message', __($message));
    }

    public function edit(Room $room)
    {
        $room_type = RoomType::all();
        return view('system_management.room.edit')->with(compact('room', 'room_type'));
    }

    public function update(RoomRequest $request, Room $room)
    {
        try {
            $this->BookingService->update($request, $room);

            $message = 'Room Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('rooms.index')
            ->with('message', __($message));
    }

    public function destroy(RoomRequest $request, Room $room)
    {
        try {
            $this->BookingService->destroy($request, $room);

            $message = 'Room Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('rooms.index')
            ->with('message', __($message));
    }

    public function getPrice(Request $request)
    {
        $price = \DB::table('price_rules')
            ->where('room_type_id', $request->Roomtype_id)
            ->first();

        if ($price != null) {
            return response()->json($price->price);
        } else {
            return response()->json('No Price Rules Created');
        }
    }

}