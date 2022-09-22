<div class="flex flex col sm:flex-row gap-2 ">

    <div class="form-control w-full max-w-xs">
        <label class="label">
            <span class="label-text">First name</span>
        </label>
        <input wire:model="contact.first_name" type="text" placeholder="Enter first name" class="input input-bordered w-full max-w-xs" />
        {{-- validation text goes here --}}
    </div>

    <div class="form-control w-full max-w-xs">
        <label class="label">
            <span class="label-text">Last name</span>
        </label>
        <input wire:model="contact.last_name" type="text" placeholder="Enter surname" class="input input-bordered w-full max-w-xs" />
        {{-- validation text goes here --}}
    </div>

    <div class="form-control w-full max-w-xs">
        <label class="label">
            <span class="label-text">Email address</span>
        </label>
        <input wire:model="contact.email" type="email" placeholder="Enter an email address" class="input input-bordered w-full max-w-xs" required />
        {{-- validation text goes here --}}
    </div>

    <div class="form-control w-full max-w-xs">
        <label class="label">
            <span class="label-text">Company</span>
        </label>
        <input wire:model="companyName" type="text" class="input input-bordered w-full max-w-xs" placeholder="Enter compnay name"/>
        @if($contact->company_id)
            <a wire:click.prevent="resetCompany">Clear</a>
        @endif

        <p>
            companyname = {{ var_dump($companyName) }}
        </p>
        <p>
            companyid = {{ var_dump($contact->company_id) }}
        </p>
        <input wire:model="contact.company_id" placeholder="coid"/>

        @if($showCompanyDropdown)
            <ul>
                @foreach ($companies as $company)
                    <li value="{{ $company->id }}">
                        <a href="" wire:click.prevent="setCompany({{ $company }})">
                            {{ $company->name }} - {{ $company->id }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
        
        {{-- validation text goes here --}}
    </div>



</div>
