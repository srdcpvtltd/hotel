<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseDataTable;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\HotelProfile;
use App\Models\Vendor;
use App\Services\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    protected $ExpenseService;

    public function __construct(ExpenseService $ExpenseService)
    {
        $this->ExpenseService = $ExpenseService;
    }
    public function management()
    {
        if (\Auth::user()->can('manage-expense')) {
            return view('expenses.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function index(ExpenseDataTable $table)
    {
        if (\Auth::user()->can('manage-expense')) {
            return $table->render('expenses.expenses.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->can('create-expense')) {

            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }
    
            $category = ExpenseCategory::where('hotel_id', $hotel->id)->get();
            $vendor = Vendor::where('hotel_id', $hotel->id)->get();
    
            return view('expenses.expenses.create', compact('category', 'vendor'));

        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $hotel_id = [
            'hotel_id' => $hotel->id,
        ];

        $message = '';
        try {
            $ExpenseService = $this->ExpenseService->store($request, Expense::class, $hotel_id);
            $message = 'Expense saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('expenses.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $Expense)
    {
        if (\Auth::user()->can('show-expense')) {

            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }
    
            return view('expenses.expenses.show')->with(compact('Expense'));

        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $Expense)
    {
        if (\Auth::user()->can('edit-expense')) {

            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }
    
            $category = ExpenseCategory::where('hotel_id', $hotel->id)->get();
            $vendor = Vendor::where('hotel_id', $hotel->id)->get();
    
            return view('expenses.expenses.edit')->with(compact('Expense','category','vendor'));

        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, Expense $Expense)
    {
        try {
            $this->ExpenseService->update($request, $Expense);

            $message = 'Expense Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('expenses.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseRequest $request, Expense $expenses)
    {
        if (\Auth::user()->can('delete-expense')) {
            
            try {
                $this->ExpenseService->destroy($request, $expenses);
    
                $message = 'Expense Deleted successfully';
            } catch (\Exception $exception) {
                $message = 'Error has Deleted';
            }
            return redirect()->route('expenses.index')
                ->with('message', __($message));

        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
