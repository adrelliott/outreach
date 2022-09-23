<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Support\Collection;
use Livewire\Component;

class Form extends Component
{
    public Contact $contact;

    public $companyName = '';

    public Collection $companyMatches;

    public $setCompany = false;
    
    public $searchForMatches = true;


    protected $rules = [
        'contact.first_name' => 'min:2|required',
        'contact.last_name' => 'min:2',
        'contact.email' => 'email',
        'contact.company_id' => '',
    ];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
        $this->clearMatches();
    }   
    
    public function render()
    {
        return view('livewire.contacts.form');
    }

    public function save()
    {
        $this->getMatches();
        if($this->companyMatches->count()) {
            var_dump('condition');
        }

        // dd('got here');

        // $this->validate();

        

        // if(! $this->contact->company_id) {
        //     $company = new Company([
        //         'name' => $this->companyName,
        //         'user_id' => auth()->user()->id
        //     ]);

        //     $company->save();
        //     $this->contact->company_id = $company->id;
        // }

        // $this->contact->save();

        // return redirect()->route('contacts.show', ['contact' => $this->contact]);
    }

    public function getMatches()
    {
        if(! $this->searchForMatches) {
            return;
        }

        // query for possible matches
        $this->companyMatches = Company::select('id', 'name')
            ->where('user_id', auth()->user()->id)
            ->when(strlen($this->companyName) > 0, function($query) {
                $query->where('name', 'like', '%' . $this->companyName . '%');
            })
            ->get();
    }

    public function setCompany(Company $company)
    {
        $this->contact->company_id = $company->id;
        $this->companyName = $company->name;
        $this->clearMatches();
        $this->setCompany = true;
    }

    public function clearCompany()
    {
        $this->contact->company_id = null;
        $this->companyName = null;
        $this->setCompany = false;
    }

    public function clearMatches($forever = false)
    {
        $this->companyMatches = collect([]);

        if($forever) {
            $this->searchForMatches = false;
        }
    }
    

}
