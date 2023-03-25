<div>
    <form wire:submit.prevent="storeContact" method="post">
        <div class="row mb-2">
            <H1 class="h4">Add a Contact</H1>
            <div class="col-sm-6 mb-2">
                <x-form.input wire:model.defer="name" type="text" name="name" label="Contact Name"
                    placeholder="Mohammad Ali Hemmati" />
            </div>
            <div class="col-sm-6 mb-2">
                <x-form.input wire:model.defer="tel" type="tel" name="tel" label="Phone Number"
                    placeholder="+989126234901" />
            </div>
        </div>
        @if ($message)
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <div class="row mb-2">
            <div class="col">
                <button type="submit" class="btn btn-primary px-5">Add</button>
            </div>
        </div>
    </form>
</div>
