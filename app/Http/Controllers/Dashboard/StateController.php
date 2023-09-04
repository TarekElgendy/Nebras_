<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\StateRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class StateController extends Controller
{
    public $resize = 1200;
    public $resizeIcons = 301;
    public function index(Request $request)
    {
        $states = State::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.states.index', compact('states'));
    }
    //end of index
    public function create()
    {
        $cities=City::where('status','active')->get();
        return view('dashboard.states.create',compact('cities'));
    }
    //end of create
    public function store(StateRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/states/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/states/', $this->resizeIcons);
        } //end of if
        State::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        // return redirect()->route('dashboard.states.index');
        return redirect()->back();
    }
    //end of store
    public function edit(State $state)
    {
        $cities=City::where('status','active')->get();

        return view('dashboard.states.edit', compact('state','cities'));
    }
    //end of edit
    public function update(StateRequest $request, State $state)
    {

        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($state->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $state->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/states/',  $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($state->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $state->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/states/',  $this->resizeIcons);
        } //end of external if
        $state->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        // return redirect()->route('dashboard.states.index');
        return redirect()->back();
    }
    //end of update
    public function destroy(State $state)
    {
        if ($state->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/states/' . $state->image);
        } //end of if
        if ($state->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/states/' . $state->icon);
        } //end of if
        $state->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
