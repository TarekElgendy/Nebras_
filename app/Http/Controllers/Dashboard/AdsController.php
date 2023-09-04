<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdsRequest;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    public $resize = 1200;
    public $resizeIcons = 301;
    public function index(Request $request)
    {
        $ads = Ads::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.ads.index', compact('ads'));
    }
    //end of index
    public function create()
    {
        return view('dashboard.ads.create');
    }
    //end of create
    public function store(AdsRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/ads/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/ads/', $this->resizeIcons);
        } //end of if

        Ads::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.ads.index');
    }
    //end of store
    public function edit(Ads $ad)
    {
        return view('dashboard.ads.edit', compact('ad'));
    }
    //end of edit
    public function update(AdsRequest $request, Ads $ad)
    {

        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($ad->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $ad->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/ads/',  $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($ad->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $ad->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/ads/',  $this->resizeIcons);
        } //end of external if
        $ad->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.ads.index');
    }
    //end of update
    public function destroy(Ads $ad)
    {
        if ($ad->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/ads/' . $ad->image);
        } //end of if
        if ($ad->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/ads/' . $ad->icon);
        } //end of if
        $ad->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
