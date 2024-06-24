<?php

namespace App\Http\Controllers;

use App\DataTables\VendorCategoryDataTable;
use App\Http\Requests\VendorCategoryRequest;
use App\Models\HotelProfile;
use App\Models\VendorCategory;
use App\Services\Vendor_categoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Vendor_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $Vendor_categoryService;

    public function __construct(Vendor_categoryService $Vendor_categoryService)
    {
        $this->Vendor_categoryService = $Vendor_categoryService;
    }

    public function index(VendorCategoryDataTable $table)
    {
        return $table->render('vendors.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorCategoryRequest $request)
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
            $Vendor_categoryService = $this->Vendor_categoryService->store($request, VendorCategory::class, $hotel_id);
            $message = 'Vendor Category saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('vendor_category.index')
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
    public function edit(VendorCategory $VendorCategory)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        
        return view('vendors.category.edit')->with(compact('VendorCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorCategoryRequest $request, VendorCategory $VendorCategory)
    {
        try {
            $this->Vendor_categoryService->update($request, $VendorCategory);

            $message = 'Vendor Category Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('vendor_category.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorCategoryRequest $request, VendorCategory $VendorCategory)
    {
        try {
            $this->Vendor_categoryService->destroy($request, $VendorCategory);

            $message = 'Vendor Category Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('vendor_category.index')
            ->with('message', __($message));
    }
}
