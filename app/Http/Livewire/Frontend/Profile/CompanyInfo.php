<?php

namespace App\Http\Livewire\Frontend\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CompanyInfo extends Component
{
    use WithFileUploads;
    public $compLegalName;
    public $compName;
    public $compPhone;
    public $compemail;
    public $compWebsite;
    public $compAddress;
    public $compLogo;
    public $compCommercialRecord;
    public $compTaxNumber;
    public $compTaxValueNumber;
    public $compIndustryRegistry;
    public $compJobTitle;
    public $compBankAccount;
    public $compBankSwift;
    public $compBankCity;
    public $compBankStockholder;
    public $compShippingAddress;
    public $image;
    public $logo;
    public $user_attachments;
    public function rules()
    {
        return [
            'compLogo' => 'nullable|image|max:1024',
            'user_attachments' => 'nullable|max:1024',
            'compLegalName' => 'nullable|string|max:255',
            'compName' => 'nullable|string|max:255',
            'compPhone' => 'nullable|string|max:255',
            'compemail' => 'nullable|string|max:255',
            'compWebsite' => 'nullable|string|max:255',
            'compAddress' => 'nullable|string|max:255',
            'compCommercialRecord' => 'nullable|string|max:255',
            'compTaxNumber' => 'nullable|string|max:255',
            'compTaxValueNumber' => 'nullable|string|max:255',
            'compIndustryRegistry' => 'nullable|string|max:255',
            'compJobTitle' => 'nullable|string|max:255',
            'compBankAccount' => 'nullable|string|max:255',
            'compBankSwift' => 'nullable|string|max:255',
            'compBankCity' => 'nullable|string|max:255',
            'compBankStockholder' => 'nullable|string|max:255',
            'compShippingAddress' => 'nullable|string|max:255',
        ];
    }
    public function render()
    {

        return view('livewire.frontend.profile.company-info', [
            'compLogo' => auth()->user()->profile->compLogo,
            'attachments' => auth()->user()->attachments,
        ]);
    }
    public function mount()
    {
        $user = auth()->user();
        // $user_attachments = $user->attachments;


        $this->compLegalName = $user->profile->compLegalName;
        $this->compName = $user->profile->compName;
        $this->compLogo = auth()->user()->profile->compLogo;
        $this->compemail = $user->profile->compemail;
        $this->compPhone = $user->profile->compPhone;
        $this->compWebsite = $user->profile->compWebsite;
        $this->compAddress = $user->profile->compAddress;
        $this->compCommercialRecord = $user->profile->compCommercialRecord;
        $this->compTaxNumber = $user->profile->compTaxNumber;
        $this->compTaxValueNumber = $user->profile->compTaxValueNumber;
        $this->compIndustryRegistry = $user->profile->compIndustryRegistry;
        $this->compJobTitle = $user->profile->compJobTitle;
        $this->compBankAccount = $user->profile->compBankAccount;
        $this->compBankSwift = $user->profile->compBankSwift;
        $this->compBankCity = $user->profile->compBankCity;
        $this->compBankStockholder = $user->profile->compBankStockholder;
        $this->compShippingAddress = $user->profile->compShippingAddress;
    }
    public function update()
    {
        $this->validate();
        $user = auth()->user();
        $profile = $user->profile;
        $profile->compLegalName = $this->compLegalName;
        $profile->compName = $this->compName;
        $profile->compemail = $this->compemail;
        $profile->compPhone = $this->compPhone;
        $profile->compWebsite = $this->compWebsite;
        $profile->compAddress = $this->compAddress;
        $profile->compCommercialRecord = $this->compCommercialRecord;
        $profile->compTaxNumber = $this->compTaxNumber;
        $profile->compTaxValueNumber = $this->compTaxValueNumber;
        $profile->compIndustryRegistry = $this->compIndustryRegistry;
        $profile->compJobTitle = $this->compJobTitle;
        $profile->compBankAccount = $this->compBankAccount;
        $profile->compBankSwift = $this->compBankSwift;
        $profile->compBankCity = $this->compBankCity;
        $profile->compBankStockholder = $this->compBankStockholder;
        $profile->compShippingAddress = $this->compShippingAddress;
        if ($this->compLogo) {
            Image::make($this->compLogo)
                ->resize(121, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/users/files/' . $this->compLogo->hashName()));
            $this->compLogo = $this->compLogo->hashName();
            if ($profile->compLogo) {
                Storage::disk('public_uploads')->delete('users/files/' . $profile->compLogo);
            }
            $profile->compLogo =    $this->compLogo;
        }
        $profile->save(); //update profile
        session()->flash('message', __('site.updated_successfully'));
        $this->render();
    }
}
