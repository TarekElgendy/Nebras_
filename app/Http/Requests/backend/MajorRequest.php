<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MajorRequest extends FormRequest
{
    public $rules = [
        'major_category_id' => 'required'
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
            $this->rules += [$locale . '.title' => 'required|unique:major_translations,title'];
        } // end of  for each
        $this->rules += ['image' => 'nullable|max:2048',];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('major');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('major_translations', 'title')->ignore($item->id, 'major_id')]];
        } // end of  for each

        $this->rules += ['image' => 'nullable|max:2048',];

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
