<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class companyInfoRequest extends FormRequest
{
    public $rules = [

        'compLogo' => 'nullable|image|max:1024',
        'user_attachments' => 'nullable|max:1024',
        'compLegalName' => 'nullable|string|max:255',
        'compName' => 'nullable|string|max:255',
        'compPhone' => 'nullable|string|max:255',
        'compemail' => 'nullable|string|max:255',
        'compWebsite' => 'nullable|string|max:255',
        'compAddress' => 'nullable|string|max:255',
        'compCommercialRecord' => 'nullable|string|max:255',
        'compTaxNumber' => 'nullable|string|max:255',
        'compTaxValueNumber' => 'nullable|string|max:255',
        'compIndustryRegistry' => 'nullable|string|max:255',
        'compJobTitle' => 'nullable|string|max:255',
        'compBankAccount' => 'nullable|string|max:255',
        'compBankSwift' => 'nullable|string|max:255',
        'compBankCity' => 'nullable|string|max:255',
        'compBankStockholder' => 'nullable|string|max:255',
        'compShippingAddress' => 'nullable|string|max:255',
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

        $this->rules += [];
        return $this->rules;
    }
    public function updateRules()
    {
        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'name.required' => __('validation.name'),

        ];
        return $msg;
    }
}
