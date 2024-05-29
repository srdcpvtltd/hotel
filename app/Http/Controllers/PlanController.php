<?php

namespace App\Http\Controllers;

use App\DataTables\PlanDataTable;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\Role;
use App\Services\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    protected $PlanService;

    public function __construct(PlanService $PlanService)
    {
        $this->PlanService = $PlanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PlanDataTable $table)
    {
        return $table->render('plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('plan.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PoliceStationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        // dd($request->all());
        $message = '';
        try {
            $PlanService = $this->PlanService->store($request, Plan::class);
            $message = 'Plan saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('plans.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $roles = Role::all();
        return view('plan.edit', compact('plan', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePoliceStationRequest  $request
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        try {

            $this->PlanService->update($request, $plan);

            $message = 'Plan Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('plans.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanRequest $request, Plan $plan)
    {
        try {
            $this->PlanService->destroy($request, $plan);

            $message = 'Plan Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('plans.index')
            ->with('message', __($message));
    }

    public function upgrade_plan()
    {
        return view('upgrade_plan.upgrade_plan');
    }
}
