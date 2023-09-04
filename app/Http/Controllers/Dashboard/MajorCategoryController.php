<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\MajorCategoryRequest;
use App\Models\MajorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MajorCategoryController extends Controller
{

    public $resize = 851;
    public function index(Request $request)
    {
        $majorCategories = MajorCategory::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->type, function ($q) use ($request) {
            return $q->where('type', $request->type);
        })->latest()->get();
        return view('dashboard.majorCategories.index', compact('majorCategories'));
    }
    //end of index
    public function create()
    {
        return view('dashboard.majorCategories.create');
    }
    //end of create
    public function store(MajorCategoryRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/majorCategories/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/majorCategories/', $this->resize);
        } //end of if
        MajorCategory::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    }
    //end of store
    public function edit(MajorCategory $majorCategory)
    {
        return view('dashboard.majorCategories.edit', compact('majorCategory'));
    }
    //end of edit
    public function update(MajorCategoryRequest $request, MajorCategory $majorCategory)
    {
        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($majorCategory->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $majorCategory->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/majorCategories/', $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($majorCategory->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $majorCategory->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/majorCategories/', $this->resize);
        } //end of external if
        $majorCategory->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.majorCategories.index',['type'=>$request->type]);
    }
    //end of update
    public function destroy(MajorCategory $majorCategory)
    {
        session()->flash('error', __('خوفا علي صحتك بلاش تمسح حاجة '));
        return redirect()->back();

        ////////
        if ($majorCategory->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/majorCategories/' . $majorCategory->image);
        } //end of if
        if ($majorCategory->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/majorCategories/' . $majorCategory->icon);
        } //end of if
        $majorCategory->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
