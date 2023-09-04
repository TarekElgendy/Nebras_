<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public $rules = [

        'orderTitle' => 'required',
        'quantity' => 'required|numeric',
        'material' => 'required',
       
        'haveSample' => 'required|in:yes,no',

        'order_attachments' => 'nullable|max:1024',
        'note' => 'nullable|max:225',
    ];

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    public function createRules()
    {
        $this->rules += ['image' => 'required|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];

        return $this->rules;
    }
    public function updateRules()
    {
        //$this->rules += ['image' => 'nullable|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            // 'name.required' => __('validation.name'),
         
        ];
        return $msg;
    }
}
