<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\ProductItemRequest;
use App\Models\Product;
use App\Models\Productitem;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductitemController extends Controller
{


    public function resize($page)
    {
        /*
        'techniques',
            'techniquesItems',
            'advantages',
            'materials',
            'finishes',
            'gallery',
            'comparisonTable',
        */
        if ($page == 'techniquesItems') {
            $resize = 85;
        } elseif ($page == 'advantages') {
            $resize = 50;
        } elseif ($page == 'gallery') {
            $resize = 352;
        } else {
            $resize = 397;
        }
        return $resize;
    } //end of resize

    public function index(Request $request)
    {
        $productitems = Productitem::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->product_id, function ($q) use ($request) {
            return $q->where('product_id', $request->product_id);
        })->when($request->type, function ($q) use ($request) {
            return $q->where('type', $request->type);
        })->latest()->get();
        $products = Product::get();
        return view('dashboard.productitems.index', compact('productitems', 'products'));
    }

    //end of index
    public function create()
    {
        $products = Product::get();
        return view('dashboard.productitems.create', compact('products'));
    }

    //end of create
    public function store(ProductItemRequest $request)
    {
        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/products/', $this->resize($request->type));
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/products/', $this->resize($request->type));
        } //end of if
        $product = Productitem::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.productitems.index');
    } //end of store




    //end of store
    public function edit(Productitem $productitem)
    {

        $products = Product::get();
        return view('dashboard.productitems.edit', compact('products', 'productitem'));
    }

    //end of edit
    public function update(ProductItemRequest $request, Productitem $productitem)
    {

        $request_data = $request->except(['image', 'icon']);

        if ($request->image) {
            if ($productitem->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $productitem->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/products/', $this->resize($request->type));
        } //end of external if

        if ($request->icon) {
            if ($productitem->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $productitem->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/products/', $this->resize($request->type));
        } //end of external if
        $productitem->update($request_data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.productitems.index');
    }

    //end of update
    public function destroy(Productitem $productitem)
    {
        if ($productitem->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/products/' . $productitem->image);
        } //end of if
        if ($productitem->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/products/' . $productitem->icon);
        } //end of if

        $productitem->delete();
        session()->flash('error', __('site.deleted_successfully'));

        return redirect()->back();
    } //end of destroy

    public function duplicate($id)
    {
        /*
            'techniques',
            'techniquesParts',
            'advantages',
            'materials',
            'finishes',
            'gallery',
            'comparisonTable', */
        $faker = Factory::create('ar_EG');  //faker Ar to generate fake data

        $item = Productitem::find($id);
        if ($item) {
            Productitem::create([
                'product_id' => $item->product_id,
                'status' => 'active',
                'type' =>  $item->type,
                'image' =>  $item->image,
                'ar' => [
                    'title' => $item->title .  $faker->numberBetween(1, 6),
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
                'en' => [
                    'title' => $item->title .  $faker->numberBetween(1, 6),
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
            ]);/* end of create */
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.productitems.index');
        }
    } //end of duplicate

}
