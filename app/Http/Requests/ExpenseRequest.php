<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\Expense;

class ExpenseRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Expense::class);
        $this->setModelActions();
        // return $this->isAuthorized();
        return true;
    }
    public function setModelActions()
    {
        $model_name = "Expense";
        $actions = $this->actions;
        foreach ($actions as $key => $action) {
            $actions[$key] = $model_name . '.' . $action;
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
        $this->setModel(Expense::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name'                      => 'required',
                'category_id'               => 'required',
                'email'                     => 'required',
                'mobile_no'                 => 'required',
                'address'                   => 'required',
                'country_id'                => 'required',
                'state_id'                  => 'required',
                'district_id'               => 'required',
                'city'                      => 'required',
                'gst_no'                    => 'required',
                'contact_person_name'       => 'required',
                'contact_person_mobile'     => 'required',
                'contact_person_email'      => 'required'
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, []);
        }

        if ($this->isUpdate()) {

            $rules = array_merge($rules, []);
        }

        return $rules;
    }
}
