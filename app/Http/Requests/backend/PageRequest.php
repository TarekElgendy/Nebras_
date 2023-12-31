<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        $this->rules += [
            'image' => 'nullable',

        ];

        return $this->rules;
    }

    public function updateRules()
    {
        $this->rules += ['image' => 'nullable'];

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
