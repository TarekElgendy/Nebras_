<?php

namespace App\Http\Requests\backend;

use App\Rules\OldPriceGreaterThanCurrentPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public $rules = [  ];

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
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => 'required|unique:product_translations,title'];
        } // end of  for each
        $this->rules += ['image' => 'required|mimes:svg,webp,jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        $this->rules += ['image2' => 'nullable|mimes:svg,webp,jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        $this->rules += [
            'category_id' => 'required',
        ];
        return $this->rules;
    }
    public function updateRules()
    {

        $item = $this->route('product');

        // $this->rules += [ 'price' => 'required', 'min:1', 'not_in:0',];
        // $this->rules += [ 'old_price' => 'nullable', 'min:1', 'not_in:0', new OldPriceGreaterThanCurrentPrice,];


        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('product_translations', 'title')->ignore($item->id, 'product_id')]];
            $this->rules += [$locale . '.title' => ['required']];
        } // end of  for each




        $this->rules += ['image' => 'nullable|mimes:svg,webp,jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        $this->rules += ['image2' => 'nullable|mimes:svg,webp,jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        return $this->rules;
    }
    public function messages()
    {
        $msg = [];
        return $msg;
    }
}
