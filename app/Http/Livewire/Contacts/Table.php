<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use App\Models\Pipeline;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination;
    
    public Collection $pipelines;
    public int $paginateLength = 10;
    public string $searchQuery = '';
    public $filterByPipelineId = '';

    public function mount()
    {
        $this->pipelines = Pipeline::where('user_id', auth()->user()->id)->get();
    }

    public function updatingSearchQuery()
    {
        $this->resetPage();
    }
    
    public function updatingFilterByPipelineId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $contacts = Contact::where('user_id', auth()->user()->id)
            ->with(['company', 'pipeline'])
            ->when($this->searchQuery != '', function($query) {
                $query->where(function ($query) {
                    $query->where('first_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('email', 'like', '%' . $this->searchQuery . '%')
                        ->orWhereHas('company', function($query){
                            $query->where('name', 'like', '%' . $this->searchQuery . '%');
                        });
                });
            })
            ->when($this->filterByPipelineId != '', function($query) {
                $query->where('pipeline_id', $this->filterByPipelineId)
                    ->where('user_id', auth()->user()->id);
            })
            ->paginate($this->paginateLength);
        
        return view('livewire.contacts.table', ['contacts' => $contacts]);
    }

}
