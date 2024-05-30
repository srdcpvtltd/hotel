<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Models\Product;

class ProductRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Product::class);
        $this->setModelActions();
        return true;

    }
    public function setModelActions(){
        $model_name="Product";
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
        $this->setModel(Product::class);
        $rules = parent::rules();

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required',
                'product_category_id' => 'required' 
            ]);
        }
        if ($this->isUpdate()) {
            $rules = array_merge($rules, [
                'name' => 'required',
                'product_category_id' => 'required'
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
