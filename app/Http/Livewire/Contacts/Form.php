<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Company;
use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public Contact $contact;

    public $companyName = '';

    public $showCompanyDropdown = false;

    protected $rules = [
        'contact.first_name' => 'min:2|required',
        'contact.last_name' => 'min:2',
        'contact.email' => 'email',
        'contact.company_id' => '',
    ];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }
            
    
    public function render()
    {
        $this->companies = Company::select('id', 'name')
            ->where('user_id', auth()->user()->id)
            ->when($this->companyName != '', function($query) {
                $query->where('name', 'like', '%' . $this->companyName . '%');
            })
            ->get();

        return view('livewire.contacts.form');
    }

    public function companyExists()
    {
        if($this->companies->contains($this->companyName))
            return true;

        else return false;
    }

    public function updatedCompanyName()
    {
        $length = Str::length($this->companyName);

        if(! $this->contact->company_id && $length >= 2) {
            $this->showCompanyDropdown = true;
        }
        elseif (! $this->companies->contains($this->companyName)) {
            $this->contact->company_id = null;
        }
    }

    public function resetCompany()
    {
        $this->contact->company_id = null;
        $this->companyName = null;
    }

    public function setCompany(Company $company)
    {
        $this->contact->company_id = $company->id;
        $this->companyName = $company->name;
        $this->showCompanyDropdown = false;
    }

}
