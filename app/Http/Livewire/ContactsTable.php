<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Contact;
use Livewire\Component;

class ContactsTable extends Component
{
    protected $company;

    public $paginateLength = 10;

    public function mount($company = null)
    {
        $this->company = $company;  
    }

    public function render()
    {
        if (! $this->company) {
            $query = auth()->user();
        }
        else {
            $query = $this->company;
        }
        $contacts = $query
            ->contacts()
            ->paginate($this->paginateLength);
        
        return view('livewire.contacts-table', ['contacts' => $contacts]);
    }

}
