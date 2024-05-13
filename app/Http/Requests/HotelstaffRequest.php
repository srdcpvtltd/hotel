<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\Designation;
use App\Models\Hotel_staff;

class HotelstaffRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Hotel_staff::class);
        $this->setModelActions();
        return true;

    }
    public function setModelActions(){
        $model_name="hotel_staff";
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
        $this->setModel(Hotel_staff::class);
        $rules = parent::rules();

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required',
                'contact_no' => 'required',
                'designation' => 'required',
                'salary' => 'required',
                'shift' => 'required',
            ]);
        }
        if ($this->isUpdate()) {
            $rules = array_merge($rules, [
                'name' => 'required',
                'contact_no' => 'required',
                'designation_id' => 'required',
                'salary' => 'required',
                'shift' => 'required',
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
