<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\Order;

class OrderRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Order::class);
        $this->setModelActions();
        // return $this->isAuthorized();
        return true;
    }
    public function setModelActions()
    {
        $model_name = "Order";
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
        $this->setModel(Order::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'room_id'   => 'required',
                'food_category_id'   => 'required',
                'food_id'          => 'required',
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
