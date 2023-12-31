<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public $rules = [
        'image' => 'required|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',
    ];
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => 'required'];
            $this->rules += [$locale . '.description' => 'required'];
        } // end of  for each
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    public function createRules()
    {
        return $this->rules;
    }
    public function updateRules()
    {
        return $rules  = [
            'image' => 'nullable|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',
            'images.*' => 'nullable|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',
        ];
    }
    public function messages()
    {
        $msg = [
            //'image.required' => __('message.image'),
        ];
        return $msg;
    }
}
