<?php

namespace App\Http\Controllers;

use App\DataTables\PriceRuleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRuleRequest;
use App\Models\HotelProfile;
use App\Models\PriceRule;
use App\Models\RoomType;
use App\Services\PriceRuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $room_type = RoomType::where('hotel_id', $hotel->id)->get();

        return view('system_management.price_rule.create', compact('room_type'));
    }

    public function store(PriceRuleRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        
        $hotel_id = [
            'hotel_id' => $hotel->id,
        ];

        $message='';
        try {
            $PriceRuleService = $this->PriceRuleService->store($request, PriceRule::class, $hotel_id);
            $message='Price Rule saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('price_rule.index')
            ->with('message', __($message));
    }

    public function edit(PriceRule $price_rule)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $room_type = RoomType::where('hotel_id', $hotel->id)->get();
        
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
