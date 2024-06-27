<?php

namespace App\Http\Controllers;

use App\DataTables\SalaryDataTable;
use App\Http\Requests\SalaryRequest;
use App\Models\Expense;
use App\Models\Hotel_staff;
use App\Models\HotelProfile;
use App\Services\SalaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    protected $SalaryService;

    public function __construct(SalaryService $SalaryService)
    {
        $this->SalaryService = $SalaryService;
    }

    public function index(SalaryDataTable $table)
    {
        return $table->render('expenses.salary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $staff = Hotel_staff::where('hotel_id', $hotel->id)->get();

        return view('expenses.salary.create', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $message = '';
        try {

            $salary = new Expense;
            $salary->hotel_id = $hotel->id;
            $salary->purchase_type = "Salary";
            $salary->vendor_id = $request->staff_id;
            $salary->amount = $request->salary;
            $salary->save();

            $message = 'Salary saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('salary.index')
            ->with('message', __($message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $salary)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $staff = Hotel_staff::where('hotel_id', $hotel->id)->get();

        return view('expenses.salary.edit')->with(compact('salary', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryRequest $request, Expense $salary)
    {
        try {
            $salary = Expense::find($salary->id);
            $salary->vendor_id = $request->staff_id;
            $salary->amount = $request->salary;
            $salary->save();

            $message = 'Salary Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('salary.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryRequest $request, Expense $salary)
    {
        try {
            $this->SalaryService->destroy($request, $salary);

            $message = 'Salary Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('salary.index')
            ->with('message', __($message));
    }
}
