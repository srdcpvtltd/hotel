<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseCategoryDataTable;
use App\Http\Requests\ExpenseCategoryRequest;
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
        return $table->render('expenses.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseCategoryRequest $request)
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
    public function edit(ExpenseCategory $expenses_category)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        return view('expenses.category.edit')->with(compact('expenses_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseCategoryRequest $request, ExpenseCategory $expenses_category)
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
    public function destroy(ExpenseCategoryRequest $request, ExpenseCategory $expenses_category)
    {
        try {
            $this->ExpenseCategoryService->destroy($request, $expenses_category);

            $message = 'Expense Category Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('expenses_category.index')
            ->with('message', __($message));
    }
}
