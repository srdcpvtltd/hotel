<?php

namespace App\Http\Controllers;

use App\DataTables\DesignationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DesignationRequest;
use App\Models\Designation;
use App\Models\HotelProfile;
use App\Services\DesignationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    protected $DesignationService;

    public function __construct(DesignationService $DesignationService)
    {
        $this->DesignationService = $DesignationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DesignationDataTable $table)
    {
        if (\Auth::user()->can('manage-Designation')) {
            return $table->render('designation.index');
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
        if (\Auth::user()->can('create-Designation')) {
            return view('designation.create');
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
    public function store(DesignationRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $message = '';
        try {
            $designation = new Designation();
            $designation->hotel_id = $hotel->id;
            $designation->designation = $request->designation;
            $designation->save();
            $message = 'Designation saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('designation.index')
            ->with('message', __($message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        if (\Auth::user()->can('edit-Designation')) {
            return view('designation.edit', compact('designation'));
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
    public function update(DesignationRequest $request, Designation $designation)
    {
        try {
            $this->DesignationService->update($request, $designation);

            $message = 'Designation Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('designation.index')
            ->with('message', __($message));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DesignationRequest $request, Designation $designation)
    {
        if (\Auth::user()->can('delete-Designation')) {
            try {
                $this->DesignationService->destroy($request, $designation);

                $message = 'Designation Deleted successfully';
            } catch (\Exception $exception) {
                $message = 'Error has Deleted';
            }
            return redirect()->route('designation.index')
                ->with('message', __($message));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
