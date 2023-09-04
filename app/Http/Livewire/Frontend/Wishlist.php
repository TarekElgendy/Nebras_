<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Wishlist extends Component
{

    public function render()
    {

        if (auth()->check()) {
            $counter=count(authUser()->wishlists);
             }else{
                 $counter=0;
             }
        return view('livewire.frontend.wishlist',compact('counter'));
    }
}
