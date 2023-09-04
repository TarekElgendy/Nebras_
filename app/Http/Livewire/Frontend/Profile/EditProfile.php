<?php

namespace App\Http\Livewire\Frontend\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EditProfile extends Component
{
    use WithFileUploads;
    public $name;
    public $compBio;
    public $compInfo1;
    public $image;
    public function rules()
    {
        return [
            'image' => 'nullable|image|max:1024',
            'compBio' => 'nullable|string|max:255',
            'compInfo1' => 'nullable|string|max:500',
            'name' => 'required|string|max:255',
        ];
    }
    public function render()
    {
        return view('livewire.frontend.profile.edit-profile', [
            'currentImage' => auth()->user()->image,
        ]);
    }

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->compBio = $user->profile->compBio;
        $this->compInfo1 = $user->profile->compInfo1;
    }
    public function update()
    {
        $this->validate();
        $user = auth()->user();
        $profile = $user->profile;
        $user->name = $this->name;
        if ($this->image) {
            Image::make($this->image)
                ->resize(121, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/users/' . $this->image->hashName()));
            $this->image = $this->image->hashName();
            if ($user->image) {
                Storage::disk('public_uploads')->delete('users/' . $user->image);
            }
            $user->image =    $this->image;
        }
        $user->save(); //update user
        $profile->compBio = $this->compBio;
        $profile->compInfo1 = $this->compInfo1;
        $profile->save(); //update profile
        session()->flash('message', __('site.updated_successfully'));
        $this->render();
        return redirect()->route('user.profile'); //return back

    }
}
