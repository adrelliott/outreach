<form wire:submit.prevent="save">
    <div class="flex flex-col sm:flex-row gap-2 ">

        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">First name</span>
            </label>
            <input wire:model.lazy="contact.first_name" type="text" placeholder="Enter first name" class="input input-bordered w-full max-w-xs" />
            {{-- validation text goes here --}}
        </div>
    
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">Last name</span>
            </label>
            <input wire:model.lazy="contact.last_name" type="text" placeholder="Enter surname" class="input input-bordered w-full max-w-xs" />
            {{-- validation text goes here --}}
        </div>
    
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">Email address</span>
            </label>
            <input wire:model.lazy="contact.email" type="email" placeholder="Enter an email address" class="input input-bordered w-full max-w-xs" required />
            {{-- validation text goes here --}}
        </div>
        
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">Company Name</span>
            </label>
            <input wire:model="companyName" type="text" placeholder="Enter a company name" class="input input-bordered w-full max-w-xs" />
            <input type="hidden" wire:model="contact.company_id">
            @if ($companyMatches != null)
                <p>Did you mean...</p>
                <ul>
                    @foreach ($companyMatches as $company)
                        <li wire:click="setCompany({{ $company }})">
                            {{ $company->name }}
                        </li>
                    @endforeach
                </ul>
            @endif
    
            @if($setCompany)
                <button wire:click="clearCompany" class="btn">RESET</button>
            @endif
            {{-- validation text goes here --}}
    
        </div>
    
    </div>   
    
    <div>
        <button type="submit" class="btn btn-primary">SAVE</button>
        @if($success)
            <div class="bg-green-200 p-4">SAVED!</div>
        @endif
    </div>
</form>