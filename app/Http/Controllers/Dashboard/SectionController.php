<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{


    public $resize = 851;
    public function index(Request $request)
    {
        $sections = Section::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.sections.index', compact('sections'));
    }

    //end of index
    public function create()
    {
        return view('dashboard.sections.create');
    }

    //end of create
    public function store(SectionRequest $request)
    {
        $request_data = $request->all();

        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/sections/', $this->resize);
        } //end of if

        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/sections/', $this->resize);
        } //end of if

        Section::create($request_data);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.sections.index');
    }

    //end of store
    public function edit(Section $section)
    {
        return view('dashboard.sections.edit', compact('section'));
    }

    //end of edit
    public function update(SectionRequest $request, Section $section)
    {

        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($section->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $section->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/sections/', $this->resize);
        } //end of external if

        if ($request->icon) {
            if ($section->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $section->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/sections/', $this->resize);
        } //end of external if
        $section->update($request_data);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.sections.index');
    }

    //end of update
    public function destroy(Section $section)
    {
        if ($section->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/sections/' . $section->image);
        } //end of if
        if ($section->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/sections/' . $section->icon);
        } //end of if

        $section->delete();
        session()->flash('error', __('site.deleted_successfully'));

        return redirect()->back();
    } //end of destroy
}
