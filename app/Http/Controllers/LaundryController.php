<?php

namespace App\Http\Controllers;

use App\DataTables\LaundryDataTable;
use App\Models\Hotel_staff;
use App\Models\HotelProfile;
use App\Models\Room;
use App\Services\LaundryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaundryController extends Controller
{
    
    protected $LaundryService;

    public function __construct(LaundryService $LaundryService)
    {
        $this->LaundryService = $LaundryService;
    }

    public function index(LaundryDataTable $table)
    {
        return $table->render('laundry.index');
    }

    public function create()
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $rooms = Room::where('hotel_id', $hotel->id)->get();
        $staffs = Hotel_staff::where('hotel_id', $hotel->id)->get();
        
        return view('laundry.create', compact('rooms','staffs'));
    }

    // public function store(HousekeepingRequest $request)
    // {
    //     $hotel = HotelProfile::where('user_id', Auth::id())->first();
    //     if (!$hotel) {
    //         return redirect('/add-hotel')->with('success', "Please create hotel first.");
    //     }
    //     $hotel_id = [
    //         'hotel_id' => $hotel->id,
    //     ];

    //     $message = '';
    //     try {
    //         $HousekeepingService = $this->HousekeepingService->store($request, Housekeeping::class, $hotel_id);
    //         if($request->status == 0){
    //             $staff = Hotel_staff::findorfail($request->assign_staff_id);
    //             $staff->status = 1;
    //             $staff->update();
                
    //             $room_clean = Room::findorfail($request->room_id);
    //             $room_clean->room_clean_status = 1;
    //             $room_clean->update();
    //         } else {
    //             $staff = Hotel_staff::findorfail($request->assign_staff_id);
    //             $staff->status = 0;
    //             $staff->update();
                
    //             $room_clean = Room::findorfail($request->room_id);
    //             $room_clean->room_clean_status = 0;
    //             $room_clean->update();
    //         }

    //         $message = 'Housekeeping saved successfully';
    //     } catch (\Exception $exception) {
    //         $message = 'Error has exit';
    //     }
    //     return redirect()->route('housekeeping.index')
    //         ->with('message', __($message));
    // }

    // public function edit(Housekeeping $housekeeping)
    // {
    //     $hotel = HotelProfile::where('user_id', Auth::id())->first();
    //     if (!$hotel) {
    //         return redirect('/add-hotel')->with('success', "Please create hotel first.");
    //     }
    //     $rooms = Room::where('hotel_id', $hotel->id)->get();
    //     $staffs = Hotel_staff::where('hotel_id', $hotel->id)->get();
        
    //     return view('housekeeping.edit', compact('housekeeping','rooms','staffs'));
    // }

    // public function update(HousekeepingRequest $request, Housekeeping $housekeeping)
    // {
    //     try {
    //         $this->HousekeepingService->update($request, $housekeeping);
    //         if($request->status == 0){
    //             $staff = Hotel_staff::findorfail($request->assign_staff_id);
    //             $staff->status = 1;
    //             $staff->update();
                
    //             $room_clean = Room::findorfail($request->room_id);
    //             $room_clean->room_clean_status = 1;
    //             $room_clean->update();
    //         } else {
    //             $staff = Hotel_staff::findorfail($request->assign_staff_id);
    //             $staff->status = 0;
    //             $staff->update();
                
    //             $room_clean = Room::findorfail($request->room_id);
    //             $room_clean->room_clean_status = 2;
    //             $room_clean->update();
    //         }

    //         $message = 'Room Updated successfully';
    //     } catch (\Exception $exception) {
    //         $message = 'Error has Update';
    //     }
    //     return redirect()->route('housekeeping.index')
    //         ->with('message', __($message));
    // }

    // public function destroy(HousekeepingRequest $request, Housekeeping $housekeeping)
    // {
    //     try {
    //         $this->HousekeepingService->destroy($request, $housekeeping);

    //         $message = 'Housekeeping Deleted successfully';
    //     } catch (\Exception $exception) {
    //         $message = 'Error has Deleted';
    //     }
    //     return redirect()->route('housekeeping.index')
    //         ->with('message', __($message));
    // }

}
