<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\MajorRequest;
use App\Models\Major;
use App\Models\MajorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MajorController extends Controller
{
    public $resize = 851;
    public function index(Request $request)
    {
        $majorCategories = MajorCategory::get();
        $majors = Major::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->major_category_id, function ($q) use ($request) {
            return $q->where('major_category_id',  $request->major_category_id);
        })->latest()->get();
        return view('dashboard.majors.index', compact('majors', 'majorCategories'));
    }
    //end of index
    public function create()
    {
        $majorCategories = MajorCategory::get();

        return view('dashboard.majors.create', compact('majorCategories'));
    }
    //end of create
    public function store(MajorRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/majors/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/majors/', $this->resize);
        } //end of if
        Major::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    }
    //end of store
    public function edit(Major $major)
    {
        $majorCategories = MajorCategory::get();
        return view('dashboard.majors.edit', compact('major','majorCategories'));
    }
    //end of edit
    public function update(MajorRequest $request, Major $major)
    {
        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($major->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $major->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/majors/', $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($major->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $major->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/majors/', $this->resize);
        } //end of external if
        $major->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.majors.index',['type'=>$request->type]);
    }
    //end of update
    public function destroy(Major $major)
    {
        
        if ($major->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/majors/' . $major->image);
        } //end of if
        if ($major->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/majors/' . $major->icon);
        } //end of if
        $major->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
