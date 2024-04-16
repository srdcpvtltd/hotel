<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\PoliceStation;

class PoliceStationRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(PoliceStation::class);
        $this->setModelActions();
        return $this->isAuthorized();

    }
    public function setModelActions(){
        $model_name="PoliceStation";
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
        $this->setModel(PoliceStation::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'code'                  => 'required',
                'city_id'               => 'required',
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
