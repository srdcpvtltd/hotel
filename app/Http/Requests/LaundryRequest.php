<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\Laundry;

class LaundryRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Laundry::class);
        $this->setModelActions();
        return true;

    }
    public function setModelActions(){
        $model_name="Laundry";
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
        $this->setModel(Laundry::class);
        $rules = parent::rules();

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'room_id' => 'required',
                'assign_staff_id' => 'required',
                'status' => 'required',
                'item' => 'required',
                'quantity' => 'required',
            ]);
        }
        if ($this->isUpdate()) {
            $rules = array_merge($rules, [
                'room_id' => 'required',
                'assign_staff_id' => 'required',
                'status' => 'required',
                'item' => 'required',
                'quantity' => 'required',
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
