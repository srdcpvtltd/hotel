<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\Hotel_staff;
use App\Models\Product_category;

class ProductCategoryRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Product_category::class);
        $this->setModelActions();
        return true;

    }
    public function setModelActions(){
        $model_name="Product_category";
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
        $this->setModel(Product_category::class);
        $rules = parent::rules();

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required',
            ]);
        }
        if ($this->isUpdate()) {
            $rules = array_merge($rules, [
                'name' => 'required',
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
