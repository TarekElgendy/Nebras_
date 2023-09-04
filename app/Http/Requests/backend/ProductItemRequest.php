<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductItemRequest extends FormRequest
{
    public $rules = [
        'type' => 'required',
        'product_id' => 'required',
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
        foreach (config('translatable.locales') as $locale) {
        //    $this->rules += [$locale . '.title' => 'required|unique:productitem_translations,title'];
            $this->rules += [$locale . '.title' => 'required'];
        } // end of  for each
        $this->rules += ['image' => 'nullable|mimes:jpg,webp,svg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        $this->rules += ['image2' => 'nullable|mimes:jpg,webp,svg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];

        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('productitem');
        foreach (config('translatable.locales') as $locale) {
            // $this->rules += [$locale . '.title' => ['required', Rule::unique('productitem_translations', 'title')->ignore($item->id, 'productitem_id')]];
            $this->rules += [$locale . '.title' => ['required']];
        } // end of  for each
        $this->rules += ['image' => 'nullable|mimes:jpg,webp,svg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        $this->rules += ['image2' => 'nullable|mimes:jpg,webp,svg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        return $this->rules;
    }
    public function messages()
    {
        $msg = [];
        return $msg;
    }
}
