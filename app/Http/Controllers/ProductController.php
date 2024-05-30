<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\ProductRequest;
use App\Models\HotelProfile;
use App\Models\Product;
use App\Models\Product_category;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    
    protected $ProductService;

    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }

    public function index(ProductDataTable $table)
    {
        return $table->render('inventory.product.index');
    }

    public function create()
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $categories = Product_category::where('hotel_id', $hotel->id)->get();
        return view('inventory.product.create',compact('categories'));
    }

    public function store(ProductRequest $request)
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
            $ProductService = $this->ProductService->store($request, Product::class, $hotel_id);
            $message = 'Product saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('product.index')
            ->with('message', __($message));
    }
    public function edit(Product $product)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $categories = Product_category::where('hotel_id', $hotel->id)->get();

        return view('inventory.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $this->ProductService->update($request, $product);

            $message='Product Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('product.index')
            ->with('message', __($message));
    }

    public function destroy(ProductRequest $request, Product $product)
    {
        try {
            $this->ProductService->destroy($request, $product);

            $message = 'Product Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('product.index')
            ->with('message', __($message));
    }

}
