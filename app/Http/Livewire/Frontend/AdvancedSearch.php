<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;

class AdvancedSearch extends Component
{
       //public $header_items;
       public function render()
       {
        $otherCategories=Category::where('status', 'active')->get();
        $brands=Brand::where('status', 'active')->get();

           return view('livewire.frontend.advanced-search',compact('otherCategories','brands'));
       }


}
