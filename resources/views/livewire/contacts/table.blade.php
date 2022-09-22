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
                <select class="select select-bordered w-full max-w-xs" >
                    <option disabled selected>Filter by pipleline</option>
                    <option>Pipeline 01</option>
                    <option>Pipeline 02</option>
                    <option>Pipeline 03</option>
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
                <th></th>
            </tr>
        </thead> 
        
        <tbody>
            @forelse($contacts as $contact)
                <tr> 
                    <td>{{ $contact->full_name }}</td> 
                    <td>{{ Str::of($contact->company->name)->limit(20, '...') }}</td> 
                    <td>{{ $contact->email }}</td> 
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