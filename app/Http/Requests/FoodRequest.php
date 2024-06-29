<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\Food;

class FoodRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Food::class);
        $this->setModelActions();
        // return $this->isAuthorized();
        return true;
    }
    public function setModelActions()
    {
        $model_name = "Food";
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
        $this->setModel(Food::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'category_id'   => 'required',
                'name'          => 'required',
                'price'         => 'required'
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
