<?php

namespace App\Http\Controllers;

use App\DataTables\HotelstaffDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\HotelstaffRequest;
use App\Models\Designation;
use App\Models\Hotel_staff;
use App\Models\HotelProfile;
use App\Models\StaffAttendance;
use App\Services\HotelstaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelStaffController extends Controller
{
    protected $HotelstaffService;

    public function __construct(HotelstaffService $HotelstaffService)
    {
        $this->HotelstaffService = $HotelstaffService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HotelstaffDataTable $table)
    {
        return $table->render('hotel_staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designation = Designation::all();

        return view('hotel_staff.create', compact('designation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelstaffRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $message = '';
        try {
            $staff = new Hotel_staff();
            $staff->hotel_id = $hotel->id;
            $staff->name = $request->name;
            $staff->contact_no = $request->contact_no;
            $staff->designation_id = $request->designation;
            $staff->salary = $request->salary;
            $staff->shift = $request->shift;
            $staff->shift_timing_start = $request->shift_timing_start;
            $staff->shift_timing_end = $request->shift_timing_end;
            $staff->save();
            $message = 'Staff saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('hotel_staff.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel_staff $hotel_staff)
    {
        $designation = Designation::all();
        return view('hotel_staff.edit', compact('hotel_staff', 'designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HotelstaffRequest $request, Hotel_staff $hotel_staff)
    {
        try {
            $this->HotelstaffService->update($request, $hotel_staff);

            $message = 'Staff Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('hotel_staff.index')
            ->with('message', __($message));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelstaffRequest $request, Hotel_staff $hotel_staff)
    {
        try {
            $this->HotelstaffService->destroy($request, $hotel_staff);

            $message = 'Staff Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('hotel_staff.index')
            ->with('message', __($message));
    }

    public function attendance()
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $staffs = Hotel_staff::where('hotel_id', $hotel->id)->get();

        return view('system_management.attendance', compact('staffs'));
    }

    public function checkin($id)
    {
        if (date('H:i:m') > "10:00:00") {
            return redirect()->back()->with('message', "Please checkin before 10 AM.");
        }
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $message = "";

        try {
            $staff = new StaffAttendance();
            $staff->hotel_id = $hotel->id;
            $staff->hotel_staff_id = $id;
            $staff->checkin = date('Y-m-d H:i:m');
            $staff->save();
            $message = 'Check In successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Checkin';
        }
        return redirect('staff_attendance')
            ->with('message', __($message));
    }

    public function checkout($id)
    {
        if (date('H:i:m') < "18:00:00") {
            return redirect()->back()->with('message', "Please checkout after 6 PM.");
        }
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $message = "";

        try {
            $staff = StaffAttendance::find($id);
            $login_hour = date('G:i', strtotime(date('Y-m-d H:i:m')) - strtotime($staff->checkin));
            $staff->checkout = date('Y-m-d H:i:m');
            $staff->login_hour = $login_hour;
            $staff->update();
            $message = 'Check Out successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Checkin';
        }
        return redirect('staff_attendance')
            ->with('message', __($message));
    }
}
