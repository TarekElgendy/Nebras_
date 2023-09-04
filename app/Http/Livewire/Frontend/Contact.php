<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Inbox;
use App\Models\Page;
use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $phone;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|min:6',
        'phone' => 'required',
        'message' => 'required',
        'email' => 'required|email',
    ];

    protected $messages = [
        // 'email.required' => 'The Email Address cannot be empty.',
        // 'email.email' => 'The Email Address format is not valid.',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function submit()
    {
        $this->validate();
        Inbox::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'message' => $this->message,
            'email' => $this->email,
        ]);
        $this->empty();

        session()->flash('message',  __('site.added_successfully'));
    }
    public function render()
    {
        $services = Page::where('type', 'services')->get();
        return view('livewire.frontend.contact', compact('services'));
    }

    public function empty()
    {
        $this->name = "";
        $this->phone = "";
        $this->message = "";
        $this->email = "";
    }
}
