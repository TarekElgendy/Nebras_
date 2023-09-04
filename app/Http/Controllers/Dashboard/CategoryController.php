<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CategoryRequest;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

     public $resizeIcons = 301;
    public function resize($type)
    {
        if ($type == 'collection') {
            $resize = 1000 ;
        }
        else {
            $resize = 1200 ;
        }
        return $resize;
    } //end of resize

    public function index(Request $request)
    {
        $sections = Section::get();
        $categories = Category::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->type, function ($q) use ($request) {
            return $q->where('type', $request->type);
        })->when($request->section_id, function ($q) use ($request) {
            return $q->where('section_id', $request->section_id);
        })->latest()->get();


        return view('dashboard.categories.index', compact('categories', 'sections'));
    }

    //end of index
    public function create()
    {
        $sections = Section::get();
        return view('dashboard.categories.create', compact('sections'));
    }

    //end of create
    public function store(CategoryRequest $request)
    {
        $request_data = $request->all();

        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/categories/', $this->resize($request->type));
        } //end of if

        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/categories/', $this->resizeIcons);
        } //end of if

        Category::create($request_data);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    //end of store
    public function edit(Category $category)
    {
        $sections = Section::get();
        return view('dashboard.categories.edit', compact('category', 'sections'));
    }

    //end of edit
    public function update(CategoryRequest $request, Category $category)
    {

        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($category->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $category->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/categories/',  $this->resize);
        } //end of external if

        if ($request->icon) {
            if ($category->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $category->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/categories/',  $this->resizeIcons);
        } //end of external if
        $category->update($request_data);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    //end of update
    public function destroy(Category $category)
    {
        if ($category->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/categories/' . $category->image);
        } //end of if
        if ($category->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/categories/' . $category->icon);
        } //end of if

        $category->delete();
        session()->flash('error', __('site.deleted_successfully'));

        return redirect()->back();
    } //end of destroy
}
