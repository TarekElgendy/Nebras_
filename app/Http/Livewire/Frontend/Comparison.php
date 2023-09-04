<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Comparison extends Component
{
    public function render()
    {
        if (auth()->check()) {
       $counter=count(authUser()->comparisons);
        }else{
            $counter=0;
        }

         return view('livewire.frontend.comparison' ,compact('counter'));
    }
}
