<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductFile;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Faker\Factory;
use App\Rules\OldPriceGreaterThanCurrentPrice;

class ProductController extends Controller
{
    public $resize = 1200; //resize dimension for main image
    public $resizeIcon = 1200; //resize dimension for icon image
    // public $resizeIcons = 301;
    public function index(Request $request)
    {
        $categories = Category::get();
        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {
            return $q->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        })->latest()
          ->select('id', 'image', 'status')
          ->withTranslation(['title']) // Eager load translated title
          ->get();

        return view('dashboard.products.index', compact('products', 'categories'));
    }
    //end of index
    public function create()
    {
        $categories = Category::get();
        $brands = Brand::where('status','active')->get();
        return view('dashboard.products.create', compact('categories','brands'));
    }
    //end of create
    public function store(ProductRequest $request)
    {
        $request_data = $request->except(['category_id','images']);
        $request->validate([
            'price' => ['required', 'min:1', 'not_in:0'],
            'old_price' => ['nullable', 'min:1', 'not_in:0', new OldPriceGreaterThanCurrentPrice],
        ]);

        $listImages = $request->images;
        $listCategories = $request->input('category_id', []);
        if ($request->image) {

            $request_data['image'] = upload_img($request->image, 'uploads/products/', $this->resize);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/products/', $this->resizeIcon);
        } //end of if
        $product = Product::create($request_data);
        if ($listImages) {
            $data = MultipleUploadImages($listImages, 'uploads/products/', 1200);
            $this->storeImages($data, $product->id);
        }

        $this->storCategoryProduct($product->id, $listCategories, 'create');
        session()->flash('success', __('site.added_successfully'));
        // return redirect()->route('dashboard.products.index');
        return redirect()->back();

    } //end of store
    public function storCategoryProduct($product_id, $listCategories, $type)
    {
        if ($type == 'create') {
            foreach ($listCategories as  $category) {
                $pc = CategoryProduct::create([
                    'product_id' => $product_id,
                    'category_id' => $category,
                ]);
            }
        } else {
            #delete all selected then create new list
            $cat = CategoryProduct::where('product_id', '=', $product_id)->delete();
            foreach ($listCategories as  $category) {
                $pc = CategoryProduct::create([
                    'product_id' => $product_id,
                    'category_id' => $category,
                ]);
            }
        }
    } //end of storCategoryProduct
    //end of store
    public function edit(Product $product)
    {
        $categories = Category::get();
        $sections = Section::get();
        $brands = Brand::where('status','active')->get();


        $unselectedCategories = Category::whereDoesntHave('products', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();
        return view('dashboard.products.edit', compact('product', 'unselectedCategories', 'brands','categories'));
    }
    //end of edit
    public function update(ProductRequest $request, Product $product)
    {
        $request_data = $request->except(['image', 'icon', 'category_id', 'images']);

        $request->validate([
            'price' => ['required', 'min:1', 'not_in:0'],
            'old_price' => ['nullable', 'min:1', 'not_in:0', new OldPriceGreaterThanCurrentPrice],
        ]);


        $listCategoris = $request->input('category_id', []);
        $listImages = $request->images;

        if ($request->image) {

            if ($product->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $product->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/products/', $this->resize);
        } //end of external if
        if ($request->icon) {
            if ($product->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $product->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/products/', $this->resizeIcon);
        } //end of external if
        $product->update($request_data);

        $this->storCategoryProduct($product->id, $listCategoris, 'update');

        if ($listImages) {
            $data = MultipleUploadImages($listImages, 'uploads/products/', 1200);
            $this->storeImages($data, $product->id);
        }
        session()->flash('success', __('site.updated_successfully'));
        // return redirect()->route('dashboard.products.index');
        return redirect()->back();

    }
    //end of update

    public function image_delete($id)
    {
        $file = ProductFile::find($id);
        if ($file) {
            Storage::disk('public_uploads')->delete('/products/' . $file->img);
            $file->delete();
        }
        session()->flash('success', __('site.deleted_successfully'));
        return back();
    } //end of image_delete
    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/products/' . $product->image);
        } //end of if
        if ($product->icon != 'default.png') {
            Storage::disk('public_uploads')->delete('/products/' . $product->icon);
        } //end of if
        $product->delete();
        session()->flash('error', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy

    public function storeImages($data, $product_id)
    {
        foreach ($data as $file) {
            ProductFile::insert([
                'type' => 'image',
                'file' => $file,
                'product_id' => $product_id,
            ]);
        }
    } //end  storeImages

    public function duplicate($id)
    {
        $faker = Factory::create(); //faker to generate fake data
        $item = Product::find($id);
        if ($item) {
            Product::create([
                'price' =>  $item->price,
                'old_price' =>  $item->old_price,
                'length' =>  $item->length,
                'width' =>  $item->width,
                'height' =>  $item->height,
                'weight' =>  $item->weight,
                'type' =>  $item->type,
                'image' =>  $faker->imageUrl(640, 480),
                'ar' => [
                    'title' =>  $faker->name,
                    'description'  =>  $faker->paragraph,
                    'short_description' =>  $faker->sentence,
                ],
                // 'en' => [
                //     'title' =>  $faker->name,
                //     'description'  =>  $faker->paragraph,
                //     'short_description' =>  $faker->sentence,
                // ],
            ]);/* end of create */
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.products.index');
        }
    } //end of duplicate

}
