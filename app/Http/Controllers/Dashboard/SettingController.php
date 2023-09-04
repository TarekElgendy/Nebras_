<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::get();

        return view('dashboard.settings.index', compact('settings'));
    }

    //end of index
    public function create()
    {
        return view('dashboard.settings.create');
    }

    //end of create
    public function store(Request $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/settings/', 1500);
        } //end of if
        Setting::create($request_data);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.settings.index');
    }

    //end of store
    public function edit(Setting $setting)
    {
        return view('dashboard.settings.edit', compact('setting'));
    }

    //end of edit
    public function update(SettingRequest $request, Setting $setting)
    {
        $request_data = $request->except(['logo', 'footer_logo', 'icon']);
        if ($request->logo) {
            if ($setting->logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $setting->logo);
            } //end of inner if
            $request_data['logo'] = upload_img($request->logo, 'uploads/setting/', 250);
        } //end of external if
        if ($request->footer_logo) {
            if ($setting->footer_logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $setting->footer_logo);
            } //end of inner if
            $request_data['footer_logo'] = upload_img($request->footer_logo, 'uploads/setting/', 250);
        } //end of external if
        if ($request->icon) {
            if ($setting->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $setting->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/setting/', 300);
        } //end of external if
        $setting->update($request_data);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.settings.index');
    }

    //end of update
    public function destroy(Setting $setting)
    {
        if ($setting->id != 1) {
            if ($setting->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/settings/' . $setting->image);
            } //end of if
            $setting->delete();
            session()->flash('error', __('site.deleted_successfully'));

            return redirect()->back();
        } else {
            $msg = "Sorry You can't remove this item ";
            session()->flash('error', $msg);

            return redirect()->back();
        }
    } //end of destroy
}
