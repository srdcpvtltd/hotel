<?php

namespace App\Http\Controllers;

use App\DataTables\LaundryDataTable;
use App\Http\Requests\LaundryRequest;
use App\Models\Hotel_staff;
use App\Models\Laundry;
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

        return view('laundry.create', compact('rooms', 'staffs'));
    }

    public function store(LaundryRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $message = '';
        try {
            $count = count($request->item);
            // $LaundryService = $this->LaundryService->store($request, Laundry::class, $hotel_id);
            for ($i = 0; $i < $count; $i++) {
                $data = new Laundry;
                $data->hotel_id = $hotel->id;
                $data->room_id = $request->room_id;
                $data->assign_staff_id = $request->assign_staff_id;
                $data->item = $request->item[$i];
                $data->quantity = $request->quantity[$i];
                $data->status = $request->status;
                $data->save();
            }

            if ($request->status == 0) {
                $staff = Hotel_staff::findorfail($request->assign_staff_id);
                $staff->status = 1;
                $staff->update();
            } else {
                $staff = Hotel_staff::findorfail($request->assign_staff_id);
                $staff->status = 0;
                $staff->update();
            }

            $message = 'Laundry order placed successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('laundry.index')
            ->with('message', __($message));
    }

    public function edit(Laundry $laundry)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $rooms = Room::where('hotel_id', $hotel->id)->get();
        $staffs = Hotel_staff::where('hotel_id', $hotel->id)->get();

        return view('laundry.edit', compact('laundry', 'rooms', 'staffs'));
    }

    public function update(LaundryRequest $request, Laundry $laundry)
    {
        try {
            $this->LaundryService->update($request, $laundry);

            $data = Laundry::where('assign_staff_id', $request->assign_staff_id)->where('status',0)->get();

            if (count($data) == 0) {
                if ($request->status == 0) {
                    $staff = Hotel_staff::findorfail($request->assign_staff_id);
                    $staff->status = 1;
                    $staff->update();
                } else {
                    $staff = Hotel_staff::findorfail($request->assign_staff_id);
                    $staff->status = 0;
                    $staff->update();
                }
            }

            $message = 'Laundry order Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('laundry.index')
            ->with('message', __($message));
    }

    public function destroy(LaundryRequest $request, Laundry $laundry)
    {
        try {
            $this->LaundryService->destroy($request, $laundry);

            $message = 'Laundry order Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('laundry.index')
            ->with('message', __($message));
    }
}
