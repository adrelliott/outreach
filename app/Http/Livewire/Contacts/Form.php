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

    public $companyMatches = null;

    public $setCompany = false;

    public bool $success = false;

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
        return view('livewire.contacts.form');
    }

    public function save()
    {
        $this->validate();

        if(! $this->contact->company_id) {
            $company = new Company([
                'name' => $this->companyName,
                'user_id' => auth()->user()->id
            ]);

            $company->save();
            $this->contact->company_id = $company->id;
        }

        $this->contact->save();
        $this->success = true;

        return redirect()->route('contacts.show', ['contact' => $this->contact]);
    }

    public function updatingCompanyName()
    {
        if(strlen($this->companyName) >= 4) {
            $this->companyMatches = Company::select('id', 'name')
            ->where('user_id', auth()->user()->id)
            ->where('name', 'like', '%' . $this->companyName . '%')
            ->get();
        }
        else {
            $this->companyMatches = null;
        }
    }

    public function setCompany(Company $company)
    {
        $this->contact->company_id = $company->id;
        $this->companyName = $company->name;
        $this->companyMatches = null;
        $this->setCompany = true;
    }

    public function clearCompany()
    {
        $this->contact->company_id = null;
        $this->companyName = null;
        $this->setCompany = false;
    }
    

}
