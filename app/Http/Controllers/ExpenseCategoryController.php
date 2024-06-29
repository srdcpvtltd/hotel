<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseCategoryDataTable;
use App\Http\Requests\FoodCategoryRequest;
use App\Models\ExpenseCategory;
use App\Models\HotelProfile;
use App\Services\ExpenseCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ExpenseCategoryService;

    public function __construct(ExpenseCategoryService $ExpenseCategoryService)
    {
        $this->ExpenseCategoryService = $ExpenseCategoryService;
    }

    public function index(ExpenseCategoryDataTable $table)
    {
        if (\Auth::user()->can('manage-expense')) {
            return $table->render('expenses.category.index');
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
            return view('expenses.category.create');
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
    public function store(FoodCategoryRequest $request)
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
            $ExpenseCategoryService = $this->ExpenseCategoryService->store($request, ExpenseCategory::class, $hotel_id);
            $message = 'Expense Category saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('expenses_category.index')
            ->with('message', __($message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expenses_category)
    {
        if (\Auth::user()->can('edit-expense')) {
            
            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }
    
            return view('expenses.category.edit')->with(compact('expenses_category'));

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
    public function update(FoodCategoryRequest $request, ExpenseCategory $expenses_category)
    {
        try {
            $this->ExpenseCategoryService->update($request, $expenses_category);

            $message = 'Expense Category Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('expenses_category.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodCategoryRequest $request, ExpenseCategory $expenses_category)
    {
        if (\Auth::user()->can('delete-expense')) {

            try {
                $this->ExpenseCategoryService->destroy($request, $expenses_category);
    
                $message = 'Expense Category Deleted successfully';
            } catch (\Exception $exception) {
                $message = 'Error has Deleted';
            }
            return redirect()->route('expenses_category.index')
                ->with('message', __($message));

        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
