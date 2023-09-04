<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
class CityRequest extends FormRequest
{

    public $rules = [];

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
            $this->rules += [$locale . '.title' => 'required|unique:city_translations,title'];
            // $this->rules += [$locale . '.description' => 'required'];
        } // end of  for each

        // $this->rules += ['image' => 'required|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('city');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('city_translations', 'title')->ignore($item->id, 'city_id')]];
            // $this->rules += [$locale . '.description' => 'required'];
        } // end of  for each
        // $this->rules += ['image' => 'nullable|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            //'image.required' => __('message.image'),
        ];
        return $msg;
    }
}
