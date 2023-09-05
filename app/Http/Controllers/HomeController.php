<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Page;
use App\Models\Product;
use App\Models\Productitem;
use App\Models\Section;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{

    public function account_blocked()
    {
        return view('frontend.user.inactiveAccount.index');
    } //end of function
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('home');
        // return redirect('login');

    } //end of logout
    public function index()
    {




        $sliders = Page::where('type', 'sliders')->where('status', 'active')->get();
        $sliderBoxs = Page::where('type', 'sliderBoxs')->where('status', 'active')->get();
        $homePageAd_3Box = Page::where('type', 'homePageAd_3Box')->where('status', 'active')->get();
        $categories = Category::where('status', 'active')->where('type','category')->get();
        $falg_categories = Category::where('status', 'active')->where('type','flagHome')->get();

        $homePageAdLarge_2Box = Page::where('type', 'homePageAdLarge_2Box')->where('status', 'active')->first();
        $homePageAdSmall_2Box = Page::where('type', 'homePageAdSmall_2Box')->where('status', 'active')->first();

        //$listSection =['exclusive','offers','feature'];

        $products = Product::where('status', 'active')->where('mainPage', 'active')->get();
        $brands = Brand::where('status', 'active')->get();


        return view('frontend.home',compact('brands','falg_categories','products','homePageAdLarge_2Box','homePageAdSmall_2Box' ,'sliders','sliderBoxs','categories','homePageAd_3Box'));
    } //end of method

    public function search(Request $request) {

        $categoryIds = $request->input('category_ids', []);
        $brandIds = $request->input('brand_ids', []);

        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })
        ->when(count($brandIds) > 0 || count($categoryIds) > 0, function ($query) use ($brandIds, $categoryIds) {
            $query->where(function ($subquery) use ($brandIds, $categoryIds) {
                if (count($brandIds) > 0) {
                    $subquery->whereIn('brand_id', $brandIds);
                }
                if (count($categoryIds) > 0) {
                    $subquery->orWhereHas('categories', function ($query) use ($categoryIds) {
                        $query->whereIn('category_id', $categoryIds);
                    });
                }
            });
        })
        ->when($request->filled('priceMin'), function ($query) use ($request) {
            $query->where('price', '>=', $request->input('priceMin'));
        })
        ->when($request->filled('priceMax'), function ($query) use ($request) {
            $query->where('price', '<=', $request->input('priceMax'));
        })
        ->where('status', 'active')
        ->paginate(10);

        $otherCategories=Category::where('status', 'active')->get();
        $brands=Brand::where('status', 'active')->get();
        $category=null;



        return view('frontend.search',compact('otherCategories','brands','categoryIds','brandIds' ,'category','products'));



    }//end of search

    public function categoryProducts($id, $slug)
    {
        $id=decodeId($id);
        $otherCategories=Category::where('id','!=',$id)->where('status', 'active')->get();
        $brands=Brand::where('status', 'active')->get();
        $category = Category::where('status', 'active')->where('id', $id)->first();
       $products = $category->products()->where('status', 'active')->paginate(10);




        return view('frontend.products',compact('otherCategories','brands' ,'category','products'));
    } //end of method

    public function brandProducts($id, $slug)
    {
        $id=decodeId($id);
        $brands = Brand::where('status', 'active')->where('id','!=', $id)->get();

       $brand = Brand::where('status', 'active')->where('id', $id)->first();
       $products = $brand->products()->where('status', 'active')->paginate(10);

       $otherCategories=Category::where('status', 'active')->get();

       $category=null;
        return view('frontend.products',compact('otherCategories','brands' ,'category','products'));
    } //end of method


    public function products($id, $slug)
    {

        $category = Category::where('status', 'active')->where('id', $id)->first();
        $products = $category->products;
        return view('frontend.products', compact('category', 'products'));
    } //end of method

    public function productDetails($id, $slug)
    {
        $id=decodeId($id);

        $product =Product::findOrfail($id);
        $averageRate = $product->rates->avg('rate');
        $spacificationList=[

           // 'stock_availability',
           // 'warranty',
            'warrantyInfo',
            'length',
            'width',
            'height',
            'weight',
          //  'taxesIncluded',
            'listAvailableColors',
          'manufacturerCountry',


            ];

        $otherProducts =Product::where('id','!=',$id)->where('brand_id',$product->brand_id)->where('status', 'active')->get()->take(2);


        return view('frontend.productDetails', compact('spacificationList','otherProducts','product'));
    } //end of method

    public function contactUs()
    {
        $services = Page::where('type', 'services')->get();
        return view('frontend.contact', compact('services'));
    } //end of method


}
