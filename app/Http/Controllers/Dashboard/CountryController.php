<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CountryController extends Controller
{
    public $resize = 1200;
    public $resizeIcons = 301;
    public function index(Request $request)
    {
        $countries = Country::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.countries.index', compact('countries'));
    }
    //end of index
    public function create()
    {
        return view('dashboard.countries.create');
    }
    //end of create
    public function store(CountryRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/countries/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/countries/', $this->resizeIcons);
        } //end of if
        Country::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.countries.index');
    }
    //end of store
    public function edit(Country $country)
    {
        return view('dashboard.countries.edit', compact('country'));
    }
    //end of edit
    public function update(CountryRequest $request, Country $country)
    {

        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($country->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $country->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/countries/',  $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($country->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $country->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/countries/',  $this->resizeIcons);
        } //end of external if
        $country->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.countries.index');
    }
    //end of update
    public function destroy(Country $country)
    {
        if ($country->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/countries/' . $country->image);
        } //end of if
        if ($country->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/countries/' . $country->icon);
        } //end of if
        $country->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
