<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
class Counter extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }




    public function render()
    {
        $users=User::get();
// dd($user);
        return view('livewire.counter',compact('users'));
    }

}
