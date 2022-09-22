<div class="overflow-x-auto">
    <table class="table table-compact w-full">
        <thead>
            <tr>
                <th></th> 
                <th class="text-left">First Name</th> 
                <th class="text-left">Last Name</th>  
                <th class="text-left">Email</th>  
                <th>Compnay_id</th>
            </tr>
        </thead> 
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <th>{{ $contact->id }}</th> 
                    <td>{{ $contact->first_name }}</td> 
                    <td>{{ $contact->last_name }}</td> 
                    <td>{{ $contact->email }}</td> 
                    <td>{{ $contact->company_id }}</td> 
                </tr>
            @empty
                <tr>
                    <td colspan="3">No contacts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>