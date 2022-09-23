<form wire:submit.prevent="save" class="z-0">
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
            <input wire:model.lazy="contact.email" type="email" placeholder="Enter an email address" class="input input-bordered w-full max-w-xs"  />
            {{-- validation text goes here --}}
        </div>
        
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">Company Name</span>
            </label>
            <input 
                wire:model.lazy="companyName" 
                type="text" 
                placeholder="Enter a company name" 
                class="input input-bordered w-full max-w-xs"
                @if($setCompany) disabled @endif
            />

            @if ($setCompany)
                <a wire:click.prevent="clearCompany" href="" class="text-sm text-gray-400 text-right mt-1 underline">
                    Clear field
                </a>
            @endif

            @if ($companyMatches->count())
                <div class="dropdown-content menu p-2 shadow bg-base-100 w-full z-20>
                    <label tabindex="0" class="btn m-1">Did you mean..</label>
                    <ul tabindex="0" ">
                        @foreach ($companyMatches as $company)
                            <li>
                                <a wire:click.prevent="setCompany({{ $company }})" href="" class="underline py-2">
                                    {{ $company->name }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a wire:click.prevent="clearMatches(true)" href="" class="py-4 italic text-right">
                                Nope, none of these...
                            </a>
                        </li>
                    </ul>
                </div>
            @endif 
        </div>  

    </div>

    <div class="flex justify-end mt-4">
        <button type="submit" class="btn btn-primary">SAVE</button>
    </div>

    <input type="text" wire:model="contact.company_id">
    {{ var_dump($searchForMatches) }}
    {{ var_dump($companyMatches->count()) }}
</form>