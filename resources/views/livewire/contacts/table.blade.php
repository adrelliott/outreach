<div class="overflow-x-auto">
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Your Contacts
        </h1>
        <div class="flex flex-col sm:flex-row gap-2 justify-end items-center mt-4 sm:mt-0">
            <div class="">
                <input wire:model="searchQuery" type="text" placeholder="Search..." class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="">
                <select wire:model="filterByPipelineId" class="select select-bordered w-full max-w-xs" >
                    <option disabled selected value="">Filter by pipeline</option>
                    @if ($filterByPipelineId != '')
                        <option wire:click="$set('filterByPipelineId', '')">
                            -- Clear the selection --
                        </option>
                    @endif
                    @forelse ($pipelines as $pipeline)
                        <option value="{{ $pipeline->id }}">
                            {{ $pipeline->name }}
                        </option>
                    @empty
                        <option>
                            <a href="/pipelines/create">Create your first pipeline</a>
                        </option>
                    @endforelse
                  </select>
            </div>
            <button class="btn btn-primary gap-2">
                Add new contact
            </button>
        </div>
    </div>
    <table class="table table-compact w-full">
        <thead>
            <tr> 
                <th class="text-left">Name</th> 
                <th class="text-left">Company</th>  
                <th class="text-left">Email</th>
                <th class="text-left">Pipeline</th>
                <th></th>
            </tr>
        </thead> 
        
        <tbody>
            @forelse($contacts as $contact)
                <tr> 
                    <td>{{ $contact->user_id }} {{ $contact->full_name }}</td> 
                    <td>{{ Str::of($contact->company->name)->limit(20, '...') }}</td> 
                    <td>{{ $contact->email }}</td> 
                    <td>{{ Str::of($contact->pipeline->name)->limit(20, '...') }}- {{ $contact->pipeline->id }}</td> 
                    <td>buttons</td> 
                </tr>
            @empty
                <tr>
                    <td colspan="3">No contacts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
</div>