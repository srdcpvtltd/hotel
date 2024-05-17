<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DistrictService;
use App\DataTables\DistrictsDataTable;
use App\Http\Requests\DistrictRequest;
use App\Models\State;
use App\Models\Country;
use App\Models\District;

class DistrictController extends Controller
{
    protected $DistrictService;

    public function __construct(DistrictService $DistrictService)
    {
        $this->DistrictService = $DistrictService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DistrictsDataTable $table)
    {
        return $table->render('districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $countries = Country::get();
        
        return view('districts.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $message='';
        try {
            //echo '<pre>';var_dump($request->all());exit;
            $DistrictService = $this->DistrictService->store($request, District::class);
            $message='District saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('districts.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $country
     * @return \Illuminate\Http\Response
     */
    public function show(District $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $countries = Country::get();
        $states = State::get();
        $selected_country_id=0;
        $selected_state_id=0;
        if($district->state!=null){
            $selected_country_id=$district->state->country_id;
            $selected_state_id=$district->state->id;
        }
        return view('districts.edit')->with(compact('district','states','countries','selected_country_id','selected_state_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DistrictRequest  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, District $district)
    {
        try {
            
            $this->DistrictService->update($request, $district);

            $message='District Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('districts.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistrictRequest $request,District $district)
    {
        try {
            $this->DistrictService->destroy($request, $district);

            $message='District Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('districts.index')
            ->with('message', __($message));
    }
}
