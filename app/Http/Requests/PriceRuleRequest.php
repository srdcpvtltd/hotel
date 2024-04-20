<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\PriceRule;

class PriceRuleRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(PriceRule::class);
        $this->setModelActions();
        // return $this->isAuthorized();
        return true;
    }
    public function setModelActions(){
        $model_name="pricerule";
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
        $this->setModel(PriceRule::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'room_type_id'                  => 'required',
                // 'rent_by_hour'                  => 'required',
                // 'rent_by_hour_price'            => 'required',
                // 'after_rent_by_hour_price'      => 'required',
                'price'                         => 'required',
                'extra_adult_price'             => 'required',
                'extra_child_price'             => 'required',
                'check_in'                      => 'required',
                'check_out'                     => 'required',
                'overtime_charge'               => 'required',
                'rounded_minutes'               => 'required',
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
