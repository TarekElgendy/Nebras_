<?php

namespace App\Http\Livewire\Frontend\Profile;

use App\Models\UserPortfolio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Portfolio extends Component
{
    use WithFileUploads;
    public $title;
    public $image;


    public function create()
    {

        $this->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:1024',
        ]);
        $user = auth()->user();
        if (count($user->portfolios) >= 6) {
            session()->flash('message', __('site.ExceededTheMximumLimit'));
        } else {
            $request_data['user_id'] = $user->id;
            $request_data['title'] = $this->title;
            if ($this->image) {
                Image::make($this->image)
                    ->resize(640, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('uploads/users/' . $this->image->hashName()));
                $request_data['file'] = $this->image->hashName();
            }
            UserPortfolio::create($request_data);
            session()->flash('message', __('site.created_successfully'));
        }
        $this->empty();
        return redirect()->route('user.portfolio'); //return back
    }

    public function render()
    {
        return view('livewire.frontend.profile.portfolio');
    }

    public function empty()
    {
        $this->title = '';
        $this->image = '';
    }
}
