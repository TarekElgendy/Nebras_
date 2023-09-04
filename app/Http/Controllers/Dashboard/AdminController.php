<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Victorybiz\GeoIPLocation\GeoIPLocation;

class AdminController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:admins-create'])->only('index');
        $this->middleware(['permission:admins-read'])->only('index');
        $this->middleware(['permission:admins-update'])->only('index');
        $this->middleware(['permission:admins-delete'])->only('index');
    }

 //end of constructor
    public function index(Request $request)
    {
        // $geoip = new GeoIPLocation();
        // // dd($geoip->getIP(), $geoip->getCountryCode());
        // if ($geoip->getCountryCode() == 'NG') {
        //     //  dd('NG');
        // }
        $admins = Admin::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->search.'%');
            });
        })->latest()->get();
        // dd($admins);
        return view('dashboard.admins.index', compact('admins'));
    }

 //end of index
    public function create()
    {
        $roles = Role::get();

        return view('dashboard.admins.create', compact('roles'));
    }

 //end of create
    public function store(AdminRequest $request)
    {
        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/admins/', 150);
        } //end of if
        $admin = Admin::create($request_data);
        $admin->attachRoles([$request->role_id]);
        // $admin->syncPermissions($request->permissions);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.admins.index');
    }

 //end of store
    public function edit(Admin $admin)
    {
        $roles = Role::get();

        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }

 //end of user
    public function edit_profile(Admin $admin)
    {
        $roles = Role::get();

        return view('dashboard.admins.edit_profile', compact('user'));
    }

 //end of user
    public function update(AdminRequest $request, Admin $admin)
    {
        $request_data = $request->except(['permissions', 'image', 'password', 'password_confirmation']);
        if ($request->password) {
            $request_data['password'] = bcrypt($request->password);
        }
        if ($request->image) {
            if ($admin->image != 'default.png') {
                Storage::disk('public_uploads')->delete('admins/'.$admin->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/admins/', 150);
        } //end of external if


        $admin->update($request_data);
        $admin->syncRoles([$request->role_id]);
        // if($request->permissions){
        //     $admin->syncPermissions($request->permissions);
        // }
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.admins.index');
    }

 //end of update
    public function destroy(Admin $admin)
    {
        if ($admin->image != 'default.png') {
            Storage::disk('public_uploads')->delete('admins/'.$admin->image);
        } //end of if
        if ($admin->id != 1) {
            $admin->delete();
            session()->flash('success', __('site.deleted_successfully'));
        } else {
            session()->flash('error', __('validation.CanNotRemoveSuperAdmin'));
        }

        return redirect()->route('dashboard.admins.index');
    } //end of destroy
}//end of controller
