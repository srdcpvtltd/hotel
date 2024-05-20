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

    public function destroy(PriceRuleRequest $request, PriceRule $price_rule)
    {
        try {
            $this->PriceRuleService->destroy($request, $price_rule);

            $message = 'Price Rule Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('price_rule.index')
            ->with('message', __($message));
    }

    //price rules APIs starts here


    public function room_type_dropDown()
    {
        $room_type = RoomType::get(['id', 'room_type']);
        if ($room_type) {
            return response()->json([
                'data' => $room_type
            ], 200);
        } else {
            return response()->json([
                'message' => "Something Went wrong"
            ], 200);
        }
    }

    public function create_price_rules(Request $request)
    {
        $rules = [
            'room_type_id' => 'required|string',
            'rent_by_hour' => 'required|in:Yes,No',
            'rent_by_hour_price' => 'required',
            'after_rent_by_hour_price' => 'required',
            'price' => 'required',
            'extra_adult_price' => 'required',
            'extra_child_price' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'overtime_charge' => 'required',
            'rounded_minutes' => 'required',
            'friday_price' => 'required',
            'saturday_price' => 'required',
            'sunday_price' => 'required',
            'holiday_price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        // Check if the validation fails
        if ($validator->fails()) {

            return response()->json([
                'message' => $validator->errors()
            ], 200);
        } else {
            $result = PriceRule::create($request->all());
            if ($result) {
                return response()->json([
                    'message' => "Price Rules Added"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something went wrong"
                ], 200);
            }
        }
    }

    //retrive price rule
    public function retrive_price_rules(Request $request)
    {
        $limit = $request->limit > 0 ? $request->limit : 10;
        $index = $request->index > 0 ? $request->index : 0;
        $serch_text = $request->search_text;
        if ($serch_text) {
            $price_rule = PriceRule::where('price', 'like', "%$serch_text%")
                ->with('room_type')
                ->limit($limit)
                ->offset($index)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $room_type = RoomType::where('room_type', 'like', "%$serch_text%")
                ->with('price_rule')
                ->limit($limit)
                ->offset($index)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            if (!empty($price_rule)) {
                return response()->json([
                    'data' => $price_rule
                ], 200);
            } else if (!empty($room_type)) {
                return response()->json([
                    'data' => $room_type
                ], 200);
            } else {
                return response()->json([
                    'message' => "No Price rules available"
                ], 200);
            }
        } else {
            $price_rule = PriceRule::with('room_type')->get();
            if ($price_rule) {
                return response()->json([
                    'data' => $price_rule
                ], 200);
            } else {
                return response()->json([
                    'message' => "No Price rules available"
                ], 200);
            }
        }
    }

    //paginate
    public function paginate(Request $request)
    {
        $record = PriceRule::with('room_type')->paginate($request->paginate);
        if ($record) {
            return response()->json([
                'data' => $record
            ], 200);
        } else {
            return response()->json([
                'message' => "No Price Rules found"
            ], 200);
        }
    }
    //update roomtype
    public function update_price_rules(Request $request)
    {
        $payload = $request->all();
        $data = PriceRule::find($request->id);
        Arr::forget($payload, 'id');

        if ($data) {
            $result = $data->update($payload);
            if ($result) {
                return response()->json([
                    'message' => "Data updated Successfully"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Failed"
                ], 200);
            }
        } else {
            return response()->json([
                'message' => "Invalid Id"
            ], 200);
        }
    }

    public function delete_price_rules(Request $request)
    {
        $pr = PriceRule::find($request->id);
        if (!$pr) {
            return response()->json([
                'message' => 'Invalid Id'
            ], 200);
        }

        // Delete the employee record
        $result = $pr->delete();

        if ($result) {
            // Deletion successful
            return response()->json([
                'message' => 'Deleted successfully'
            ], 200);
        } else {
            // Deletion failed
            return response()->json([
                'message' => 'Failed to delete data'
            ], 200);
        }
    }
}
