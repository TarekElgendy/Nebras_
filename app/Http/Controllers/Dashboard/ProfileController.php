<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return back();
    }
    public function create()
    {
        return back();
    }
    public function store(Request $request)
    {
        return back();
    }
    public function show(Admin $admin)
    {
        return back();
    }
    public function edit($admin)
    {
        $admin = Admin::where('id', '=', $admin)->first();
        return view('dashboard.admins.profile.edit', compact('admin'));
    }
    public function update(Request $request,  $admin)
    {
        $admin = Admin::where('id', '=', $admin)->first();
        $validator =  $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpg,webp,svg,bmp,jpeg,gif,png,eps,raw,cr2,nef,orf,sr2,tif,tiff',
            'oldPassword' => 'nullable',
            'password' => 'nullable|string|min:6',
            'confirm_password' => 'nullable|same:password|min:6',
        ]);
        $request_data = $request->except(['permissions', 'image', 'password', 'oldPassword', 'password_confirmation']);

        if ($request->password) {

            if (Hash::check($request->oldPassword, $admin->password)) {
                $request_data['password'] = bcrypt($request->password);
            } else {
                session()->flash('error', 'Password does not match');
                return redirect()->back();
            }
        }



        if ($request->image) {
            if ($admin->image != 'default.png') {
                Storage::disk('public_uploads')->delete('admins/' . $admin->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/admins/', 150);
        } //end of external if
        $admin->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    }
    //end of update
    public function destroy(Admin $admin)
    {
        return back();
    }
}
