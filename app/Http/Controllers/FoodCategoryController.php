<?php

namespace App\Http\Controllers;

use App\DataTables\FoodCategoryDataTable;
use App\Http\Requests\FoodCategoryRequest;
use App\Models\FoodCategory;
use App\Models\HotelProfile;
use App\Services\FoodCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $FoodCategoryService;

    public function __construct(FoodCategoryService $FoodCategoryService)
    {
        $this->FoodCategoryService = $FoodCategoryService;
    }

    public function index(FoodCategoryDataTable $table)
    {
        if (\Auth::user()->can('manage-food')) {
            return $table->render('food.category.index');
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
        if (\Auth::user()->can('create-food')) {
            return view('food.category.create');
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
            $FoodCategoryService = $this->FoodCategoryService->store($request, FoodCategory::class, $hotel_id);
            $message = 'Food Category saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('food_category.index')
            ->with('message', __($message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodCategory $food_category)
    {
        if (\Auth::user()->can('edit-food')) {
            
            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }
    
            return view('food.category.edit')->with(compact('food_category'));

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
    public function update(FoodCategoryRequest $request, FoodCategory $food_category)
    {
        try {
            $this->FoodCategoryService->update($request, $food_category);

            $message = 'Food Category Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('food_category.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodCategoryRequest $request, FoodCategory $food_category)
    {
        if (\Auth::user()->can('delete-food')) {

            try {
                $this->FoodCategoryService->destroy($request, $food_category);
    
                $message = 'Food Category Deleted successfully';
            } catch (\Exception $exception) {
                $message = 'Error has Deleted';
            }
            return redirect()->route('food_category.index')
                ->with('message', __($message));

        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
