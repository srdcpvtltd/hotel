<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\AdvanceBooking;

class BookingRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(AdvanceBooking::class);
        $this->setModelActions();
        return true;

    }
    public function setModelActions(){
        $model_name="advancebooking";
        $actions=$this->actions;
        foreach ($actions as $key => $action) {
            $actions[$key]=$model_name.'.'.$action;
        }
        $this->setActions($actions);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(AdvanceBooking::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name'                  => 'required',
                'phone_number'          => 'required',
                'room_type_id'          => 'required',
                'from_date'             => 'required',
                'to_date'               => 'required',
                // 'advance_payment'       => 'required',
                // 'total_price'           => 'required',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
