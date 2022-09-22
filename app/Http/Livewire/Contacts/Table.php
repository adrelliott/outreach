<?php

namespace App\Http\Livewire\Contacts;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination;
    
    public Collection $pipelines;
    public int $paginateLength = 10;
    public string $searchQuery = '';

    public function mount()
    {
        // $this->pipelines = Pipeline::all();
    }

    public function updatingSearchQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $contacts = auth()->user()
            ->contacts()
            ->with('company')
            ->when($this->searchQuery != '', function($query) {
                $query->where('first_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $this->searchQuery . '%');
            })
            ->paginate($this->paginateLength);
        
        return view('livewire.contacts.table', ['contacts' => $contacts]);
    }

}
