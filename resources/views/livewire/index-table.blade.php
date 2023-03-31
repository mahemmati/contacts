<div>
    <div class="row mb-4">
        <div class="col">
            <h1 class="h5 d-inline-block me-2">Your Contacts</h1>
            <button wire:click='createContact' type="button" class="btn btn-primary">Create</button>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <input wire:model='search' class="form-control" type="search" placeholder="Search Names or Numbers"
                aria-label="Search">
        </div>
    </div>


    @if ($contacts->count())
        <table class="table table-striped mb-4">
            <thead>
                <tr>
                    <th wire:click="toggleSort('name')" scope="col">
                        <span>Name</span>
                        @if ($sortColumn == 'name')
                            @if ($sortDir == 'asc')
                                <i class="bi bi-caret-up small"></i>
                            @endif
                            @if ($sortDir == 'desc')
                                <i class="bi bi-caret-down small"></i>
                            @endif
                        @endif
                    </th>
                    <th wire:click="toggleSort('tel')" scope="col">
                        <span>Number</span>
                        @if ($sortColumn == 'tel')
                            @if ($sortDir == 'asc')
                                <i class="bi bi-caret-up small"></i>
                            @endif
                            @if ($sortDir == 'desc')
                                <i class="bi bi-caret-down small"></i>
                            @endif
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr wire:click="showContact({{ $contact->id }})" @class(['table-success' => $contact->id == $contactOfInterest?->id])>
                        <td>
                            <span>{{ $contact->name }}</span>
                            @if ($contact->notes)
                                <i class="bi bi-card-text text-muted"></i>
                            @endif
                        </td>
                        <td>{{ $contact->tel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row align-items-center">
            <div class="col-auto">
                {{ $contacts->links() }}
            </div>
        </div>
    @else
        <p class="text-center py-5 fw-bold">No contacts available</p>
    @endif
    <x-contact-edit-form-modal :modal="$modal" />
    <x-delete-contact-modal :contact="$contactOfInterest" />
    <x-contact-details-modal :contact="$contactOfInterest" />
</div>
