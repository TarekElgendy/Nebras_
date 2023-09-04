<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public $rules = [

        'order_id' => 'required|numeric',
        'dateFrom' => 'required|numeric',
        'dateTo' => 'required|numeric',
        'priceUnit' => 'required|numeric',
        'priceDeposit' => 'required|numeric',
        'priceTotal' => 'required|numeric',
       // 'priceSample' => 'required|numeric',
        'provideSample' =>'required|in:yes,no',
        'madeSameSample' => 'required|in:yes,no',
        'manufacturingMethod' => 'required',
        'notes' => 'required|max:1024',


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
        $this->rules += ['file' => 'nullable|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];

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
