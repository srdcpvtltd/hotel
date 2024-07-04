<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Http\Requests\OrderRequest;
use App\Models\BookingRoom;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\HotelProfile;
use App\Models\Order;
use App\Models\Room;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $OrderService;

    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }

    public function index(OrderDataTable $table)
    {
        if (\Auth::user()->can('manage-order')) {
        return $table->render('order.index');
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
        if (\Auth::user()->can('create-order')) {

        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $categories = FoodCategory::where('hotel_id', $hotel->id)->get();
        $rooms = Room::where('hotel_id', $hotel->id)->where('status', 1)->get();

        return view('order.create', compact('categories', 'rooms'));
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
    public function store(OrderRequest $request)
    {
        
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        if($request->room_name != null){
            $booking = BookingRoom::where('room_number',$request->room_name)->orderBy('id','DESC')->first();
        }

        $hotel_id = [
            'hotel_id' => $hotel->id,
            'booking_id' => $booking->booking_id,
        ];

        $message = '';
        try {
            $OrderService = $this->OrderService->store($request, Order::class, $hotel_id);
            $message = 'Order Placed successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('order.index')
            ->with('message', __($message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if (\Auth::user()->can('edit-order')) {

        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $categories = FoodCategory::where('hotel_id', $hotel->id)->get();
        $foods = Food::where('hotel_id', $hotel->id)->get();
        $rooms = Room::where('hotel_id', $hotel->id)->get();

        return view('order.edit')->with(compact('foods','categories','rooms','order'));
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
    public function update(OrderRequest $request, Order $order)
    {
        try {
            $this->OrderService->update($request, $order);

            $message = 'Order Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('order.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderRequest $request, Order $order)
    {
        if (\Auth::user()->can('delete-order')) {

        try {
            $this->OrderService->destroy($request, $order);

            $message = 'Order Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('order.index')
            ->with('message', __($message));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function getFood(Request $request)
    {
        $foods = Food::where('category_id', $request->category_id)->get();
        if (count($foods) > 0) {
            return response()->json($foods);
        }
    }

    public function getFoodPrice(Request $request)
    {
        $price = Food::where('id', $request->food_id)->first();
        return response()->json($price);
    }
}
