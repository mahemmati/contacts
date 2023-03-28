<div>
    <div class="row mb-4">
        <div class="col">
            <h1 class="h5 d-inline-block me-2">Your Contacts</h1>
            <button wire:click='createContact' type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#contactFormModal">Create</button>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <input wire:model='search' class="form-control" type="search" placeholder="Search Names or Numbers" aria-label="Search">
        </div>
    </div>


    @if ($contacts->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr wire:click="showContact({{ $contact->id }})" @class(['table-success' => $contact->id == $contactOfInterest?->id])>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->tel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center py-5 fw-bold">No contacts available</p>
    @endif
    <x-contact-form-modal :modal="$modal" />
    <x-delete-contact-modal :contact="$contactOfInterest" />
    <x-contact-details-modal :contact="$contactOfInterest" />
</div>
