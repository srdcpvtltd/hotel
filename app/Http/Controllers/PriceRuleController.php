<?php

namespace App\Http\Controllers;

use App\DataTables\PriceRuleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRuleRequest;
use App\Models\PriceRule;
use App\Models\RoomType;
use App\Services\PriceRuleService;
use Illuminate\Http\Request;

class PriceRuleController extends Controller
{
    protected $PriceRuleService;

    public function __construct(PriceRuleService $PriceRuleService)
    {
        $this->PriceRuleService = $PriceRuleService;
    }

    public function index(PriceRuleDataTable $table){
        return $table->render('system_management.price_rule.index');
    }

    public function create()
    {
        $room_type = RoomType::all();

        return view('system_management.price_rule.create', compact('room_type'));
    }

    public function store(PriceRuleRequest $request)
    {
        $message='';
        try {
            $PriceRuleService = $this->PriceRuleService->store($request, PriceRule::class);
            $message='Price Rule saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('price_rule.index')
            ->with('message', __($message));
    }

    public function edit(PriceRule $price_rule)
    {
        $room_type = RoomType::all();
        return view('system_management.price_rule.edit')->with(compact('price_rule', 'room_type'));
    }

    public function update(PriceRuleRequest $request, PriceRule $price_rule)
    {
        try {
            $this->PriceRuleService->update($request, $price_rule);

            $message='Price Rule Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('price_rule.index')
            ->with('message', __($message));
    }

    public function destroy(PriceRuleRequest $request,PriceRule $price_rule)
    {
        try {
            $this->PriceRuleService->destroy($request, $price_rule);

            $message='Price Rule Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('price_rule.index')
            ->with('message', __($message));
    }
}
