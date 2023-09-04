<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public $resize = 1200;
    public $resizeIcons = 301;
    public function index(Request $request)
    {
        $cities = City::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.cities.index', compact('cities'));
    }
    //end of index
    public function create()
    {
        return view('dashboard.cities.create');
    }
    //end of create
    public function store(CityRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/cities/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/cities/', $this->resizeIcons);
        } //end of if
        City::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        // return redirect()->route('dashboard.cities.index');
        return redirect()->back();


    }
    //end of store
    public function edit(City $city)
    {
        return view('dashboard.cities.edit', compact('city'));
    }
    //end of edit
    public function update(CityRequest $request, City $city)
    {

        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($city->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $city->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/cities/',  $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($city->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $city->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/cities/',  $this->resizeIcons);
        } //end of external if
        $city->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
        } //end of update
    public function destroy(City $city)
    {
        if ($city->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/cities/' . $city->image);
        } //end of if
        if ($city->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/cities/' . $city->icon);
        } //end of if
        $city->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
