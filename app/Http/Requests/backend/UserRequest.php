<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
{
    public $rules = [

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


    $this->rules += [

            'name' => 'required',
            'email' => ['required', 'string', 'email', 'unique:users'],
            'image' => 'mimes:jpg,webp,svg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff',
            'password' => 'required|confirmed',
    ];
    return $this->rules;


}
public function updateRules()
{
    $user = $this->route('user');
    $this->rules += [

        'name' => 'required',
        'email' => ['required', Rule::unique('users')->ignore($user->id)],
        'image' => 'mimes:jpg,webp,svg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff',
        // 'password' => 'nullable|string|min:6',
        // 'confirm_password' => 'nullable|same:password|min:6',
    ];

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
