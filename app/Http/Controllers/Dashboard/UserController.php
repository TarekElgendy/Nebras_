<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->when($request->status, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })->when($request->id, function ($q) use ($request) {
            return $q->where('id', $request->id);
        })->latest()->get();
        // dd($users);
        return view('dashboard.users.index', compact('users'));
    } //end of index
    public function create()
    {
        return view('dashboard.users.create');
    } //end of create
    public function store(UserRequest $request)
    {
        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);
        if ($request->image) {
            Image::make($request->image)
                ->resize(121, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/users/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if
        User::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
    } //end of store
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    } //end of edit
    public function update(UserRequest $request, User $user)
    {
        $request_data = $request->except(['permissions', 'image', 'password', 'password_confirmation']);
        // if ($request->password) {
        //     $request_data['password'] = bcrypt($request->password);
        // }
        if ($request->image) {
            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('users/' . $user->image);
            } //end of inner if
            Image::make($request->image)
                ->resize(121, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/users/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of external if
        $user->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    } //end of update
    public function destroy(User $user)
    {
        if (!$user) {
            return redirect()->back();
        }
        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('users/' . $user->image);
        } //end of if
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    } //end of destroy
    public function export()
    {
        return Excel::download(new UsersExport,  'users-' . Carbon::now() . '.xlsx');
    } ///end export
}//end of controller
