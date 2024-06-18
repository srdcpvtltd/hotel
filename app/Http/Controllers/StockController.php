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

        return view('inventory.stock.create', compact('categories', 'products', 'hotel'));
    }

    public function store(Request $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $prduct = Product::where('id',$request->product_id)->first();
        if($prduct->stock < $request->quantity && $request->stock == "Out"){
            return redirect()->back()->with('error', __('Stock Not Available'));
        }

        try {
            request()->validate([
                'product_category_id' => 'required',
                'product_id' => 'required',
                'stock' => 'required',
                'quantity' => 'required',
            ]);

            $stock = new Stock();
            $stock->hotel_id = $hotel->id;
            $stock->product_category_id = $request->product_category_id;
            $stock->product_id = $request->product_id;
            $stock->stock = $request->stock;
            $stock->quantity = $request->quantity;
            $stock->created_at = date('Y-m-d H:i:m');
            $stock->save();
            
            if($request->stock == "In"){
                $product = Product::where('id',$request->product_id)->first();
                $product->stock = $product->stock + $request->quantity;
                $product->updated_at = date('Y-m-d H:i:m');
                $product->update();
            } else {
                $product = Product::where('id',$request->product_id)->first();
                $product->stock = $product->stock - $request->quantity;
                $product->updated_at = date('Y-m-d H:i:m');
                $product->update();
            }

            return redirect()->back()->with('message', __('Stock Added Successfully'));
        } catch (Exception $e) {
            request()->session()->flash('error', $e->getMessage());
            return back()->withInput($request->all());
        }
    }

    public function get_Product(Request $request)
    {
        $product = Product::where('product_category_id', $request->ProductCategory_id)->get();
        return response()->json($product);
    }

    public function get_Product_stock(Request $request)
    {
        $stockIn = Stock::where('product_id', $request->Product_id)
            ->where('stock', 'In')
            ->sum('quantity');

        $stockOut = Stock::where('product_id', $request->Product_id)
            ->where('stock', 'Out')
            ->sum('quantity');

        $total = $stockIn - $stockOut;

        return response()->json($total);
    }
}
