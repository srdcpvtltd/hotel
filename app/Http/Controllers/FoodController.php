<?php

namespace App\Http\Controllers;

use App\DataTables\FoodDataTable;
use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\HotelProfile;
use App\Services\FoodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    protected $FoodService;

    public function __construct(FoodService $FoodService)
    {
        $this->FoodService = $FoodService;
    }
    public function management()
    {
        if (\Auth::user()->can('manage-food')) {
        return view('food.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function index(FoodDataTable $table)
    {
        if (\Auth::user()->can('manage-food')) {
            return $table->render('food.food.index');
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

            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }

            $category = FoodCategory::where('hotel_id', $hotel->id)->get();

            return view('food.food.create', compact('category'));
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
    public function store(FoodRequest $request)
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
            $FoodService = $this->FoodService->store($request, Food::class, $hotel_id);
            $message = 'Food saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('food.index')
            ->with('message', __($message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        if (\Auth::user()->can('edit-food')) {

            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }

            $category = FoodCategory::where('hotel_id', $hotel->id)->get();

            return view('food.food.edit')->with(compact('food', 'category'));
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
    public function update(FoodRequest $request, Food $food)
    {
        try {
            $this->FoodService->update($request, $food);

            $message = 'Food Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('food.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodRequest $request, Food $food)
    {
        if (\Auth::user()->can('delete-food')) {

            try {
                $this->FoodService->destroy($request, $food);

                $message = 'Food Deleted successfully';
            } catch (\Exception $exception) {
                $message = 'Error has Deleted';
            }
            return redirect()->route('food.index')
                ->with('message', __($message));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
