<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BrandController extends Controller
{
    public $resize = 1200;
    public $resizeIcons = 301;
    public function index(Request $request)
    {
        $brands = Brand::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.brands.index', compact('brands'));
    }
    //end of index
    public function create()
    {
        return view('dashboard.brands.create');
    }
    //end of create
    public function store(BrandRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/brands/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/brands/', $this->resizeIcons);
        } //end of if
        Brand::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.brands.index');
    }
    //end of store
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    }
    //end of edit
    public function update(BrandRequest $request, Brand $brand)
    {
       
        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            if ($brand->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $brand->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/brands/',  $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($brand->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $brand->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/brands/',  $this->resizeIcons);
        } //end of external if
        $brand->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.brands.index');
    }
    //end of update
    public function destroy(Brand $brand)
    {
        if ($brand->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/brands/' . $brand->image);
        } //end of if
        if ($brand->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/brands/' . $brand->icon);
        } //end of if
        $brand->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
