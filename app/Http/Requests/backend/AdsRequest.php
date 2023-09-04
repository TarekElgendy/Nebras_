<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
{

    public $rules = [

        // 'image' => 'required|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',
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
             $this->rules += [$locale . '.title' => 'required'];
             $this->rules += [$locale . '.description' => 'required'];
         } // end of  for each
         return $rules  = ['image' => 'required|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];
     }
     public function updateRules()
     {
         $this->rules += ['image' => 'nullable|mimes:jpg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff,|max:2048',];

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
