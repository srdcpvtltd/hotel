<?php

namespace App\Http\Controllers;

use App\Models\HotelProfile;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function stock()
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $categories = Product_category::where('hotel_id', $hotel->id)->get();
        $products = Product::where('hotel_id', $hotel->id)->get();

        return view('inventory.stock.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        try {
            request()->validate([
                'product_category_id' => 'required',
                'product_id' => 'required',
                'stock' => 'required',
                'quantity' => 'required',
            ]);

            $stock = new Stock();
            $stock->hotel_name = $request->hotel_name;
            $stock->save();

        } catch (Exception $e) {
            request()->session()->flash('error', $e->getMessage());
            return back()->withInput($request->all());
        }
    }
}
