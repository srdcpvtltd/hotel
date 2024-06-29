<?php

namespace App\Http\Controllers;

use App\DataTables\VendorDataTable;
use App\Http\Requests\VendorRequest;
use App\Models\Country;
use App\Models\District;
use App\Models\HotelProfile;
use App\Models\State;
use App\Models\Vendor;
use App\Models\VendorCategory;
use App\Services\VendorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $VendorService;

    public function __construct(VendorService $VendorService)
    {
        $this->VendorService = $VendorService;
    }

    public function management()
    {
        if (\Auth::user()->can('manage-vendor')) {
            return view('vendors.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function index(VendorDataTable $table)
    {
        if (\Auth::user()->can('manage-vendor')) {
            return $table->render('vendors.vendor.index');
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
        if (\Auth::user()->can('create-vendor')) {
            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }

            $category = VendorCategory::where('hotel_id', $hotel->id)->get();
            $country = Country::all();

            return view('vendors.vendor.create', compact('category', 'country'));
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
    public function store(VendorRequest $request)
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
            $VendorService = $this->VendorService->store($request, Vendor::class, $hotel_id);
            $message = 'Vendor saved successfully';
        } catch (\Exception $exception) {
            dd($exception);
            $message = 'Error has exit';
        }
        return redirect()->route('vendors.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $Vendor)
    {
        if (\Auth::user()->can('show-vendor')) {

            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }

            return view('vendors.vendor.show')->with(compact('Vendor'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $Vendor)
    {
        if (\Auth::user()->can('edit-vendor')) {

            $hotel = HotelProfile::where('user_id', Auth::id())->first();
            if (!$hotel) {
                return redirect('/add-hotel')->with('success', "Please create hotel first.");
            }

            $category = VendorCategory::where('hotel_id', $hotel->id)->get();
            $country = Country::all();
            $states = State::all();
            $districts = District::all();

            return view('vendors.vendor.edit')->with(compact('Vendor', 'category', 'country', 'states', 'districts'));
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
    public function update(VendorRequest $request, Vendor $Vendor)
    {
        try {
            $this->VendorService->update($request, $Vendor);

            $message = 'Vendor Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('vendors.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorRequest $request, Vendor $Vendor)
    {
        if (\Auth::user()->can('delete-vendor')) {

            try {
                $this->VendorService->destroy($request, $Vendor);

                $message = 'Vendor Deleted successfully';
            } catch (\Exception $exception) {
                $message = 'Error has Deleted';
            }
            return redirect()->route('vendors.index')
                ->with('message', __($message));

        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
