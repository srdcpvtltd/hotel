<?php

namespace App\Http\Controllers;

use App\DataTables\ProductCategoryDataTable;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\HotelProfile;
use App\Models\Product_category;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    protected $ProductCategoryService;

    public function __construct(ProductCategoryService $ProductCategoryService)
    {
        $this->ProductCategoryService = $ProductCategoryService;
    }

    public function index(ProductCategoryDataTable $table)
    {
        return $table->render('inventory.product_category.index');
    }

    public function create()
    {
        return view('inventory.product_category.create');
    }

    public function store(ProductCategoryRequest $request)
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
            $ProductCategoryService = $this->ProductCategoryService->store($request, Product_category::class, $hotel_id);
            $message = 'Product category saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('product_category.index')
            ->with('message', __($message));
    }
    public function edit(Product_category $product_category)
    {
        return view('inventory.product_category.edit', compact('product_category'));
    }

    public function update(ProductCategoryRequest $request, Product_category $product_category)
    {
        try {
            $this->ProductCategoryService->update($request, $product_category);

            $message='Product Category Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('product_category.index')
            ->with('message', __($message));
    }

    public function destroy(ProductCategoryRequest $request, Product_category $product_category)
    {
        try {
            $this->ProductCategoryService->destroy($request, $product_category);

            $message = 'Product Category Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('product_category.index')
            ->with('message', __($message));
    }
}
