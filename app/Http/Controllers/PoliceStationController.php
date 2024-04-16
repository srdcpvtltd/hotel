<?php

namespace App\Http\Controllers;

use App\DataTables\PoliceStationsDataTable;
use App\Http\Requests\PoliceStationRequest;
use App\Services\PoliceStationService;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\PoliceStation;

class PoliceStationController extends Controller
{
    protected $PoliceStationService;

    public function __construct(PoliceStationService $PoliceStationService)
    {
        $this->PoliceStationService = $PoliceStationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PoliceStationsDataTable $table)
    {
        return $table->render('police_stations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        
        return view('police_stations.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PoliceStationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoliceStationRequest $request)
    {
        $message='';
        try {
            $PoliceStationService = $this->PoliceStationService->store($request, PoliceStation::class);
            $message='Police station saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('police_stations.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function show(PoliceStation $policeStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function edit(PoliceStation $policeStation)
    {
        $countries = Country::get();
        $states = State::get();
        $districts = District::get();
        $cities = City::get();

        $city = City::where('id', $policeStation->city->id)->first();
        $district = District::where('id', $policeStation->city->district_id)->first();
        $state = State::where('id', $district->state_id)->first();
        $country = Country::where('id', $state->country_id)->first();

        $selected_country_id=0;
        $selected_state_id=0;
        if($policeStation->city!=null){
            $selected_country_id = $country->id;
            $selected_state_id = $state->id;
            $selected_district_id = $district->id;
            $selected_city_id = $city->id;
        }

        return view('police_stations.edit')->with(compact('policeStation', 'cities','districts', 'states','countries','selected_country_id','selected_state_id', 'selected_district_id', 'selected_city_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePoliceStationRequest  $request
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function update(PoliceStationRequest $request, PoliceStation $policeStation)
    {
        try {
            
            $this->PoliceStationService->update($request, $policeStation);

            $message='Police Station Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('police_stations.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoliceStationRequest $request, PoliceStation $policeStation)
    {
        try {
            $this->PoliceStationService->destroy($request, $policeStation);

            $message='Police Station Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('police_stations.index')
            ->with('message', __($message));
    }
}
