<?php

namespace App\Http\Controllers;

use App\DataTables\RoomTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeRequest;
use App\Models\RoomType;
use App\Services\RoomTypeService;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $RoomTypeService;

    public function __construct(RoomTypeService $RoomTypeService)
    {
        $this->RoomTypeService = $RoomTypeService;
    }

    public function index(RoomTypeDataTable $table){
        return $table->render('system_management.room_type.index');
    }

    public function create()
    {
        return view('system_management.room_type.create');
    }

    public function store(RoomTypeRequest $request)
    {
        $message='';
        try {
            $RoomTypeService = $this->RoomTypeService->store($request, RoomType::class);
            $message='Room Type saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('room_type.index')
            ->with('message', __($message));
    }

    public function edit(RoomType $room_type)
    {

        return view('system_management.room_type.edit')->with(compact('room_type'));
    }

    public function update(RoomTypeRequest $request, RoomType $room_type)
    {
        try {
            $this->RoomTypeService->update($request, $room_type);

            $message='Room Type Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('room_type.index')
            ->with('message', __($message));
    }

    public function destroy(RoomTypeRequest $request,RoomType $room_type)
    {
        try {
            $this->RoomTypeService->destroy($request, $room_type);

            $message='Room Type Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('room_type.index')
            ->with('message', __($message));
    }
}
