<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;

class Header extends Component
{
   //public $header_items;
    public function render()
    {
        $headerFlagCategories = Category::where('status', 'active')->where('type','flagHome')->get();
        $headerMainCategories = Category::where('status', 'active')->where('type','!=','flagHome')->get();
        $headerBrands = Brand::where('status', 'active')->get();


        return view('livewire.frontend.header',compact('headerFlagCategories','headerMainCategories','headerBrands'));
    }
}
