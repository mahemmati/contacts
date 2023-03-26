<div>
    <div class="row mb-4">
        <div class="col">
            <h1 class="h4 d-inline-block me-2">Your Contacts</h1>
            <button wire:click='createContact' type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactFormModal">Create</button>
        </div>
    </div>


    @if ($contacts->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Number</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr @class(['table-success' => $contact->id == $contactOfInterest?->id])>
                        <th scope="row">{{ $contact->id }}</th>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->tel }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a wire:click="editContact({{ $contact->id }})" class="dropdown-item">Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger-emphasis" data-bs-toggle="modal"
                                            data-bs-target="#confirmDelete"
                                            data-bs-contact="{{ $contact->id }}">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center py-5 fw-bold">No contacts added yet!</p>
    @endif
    <x-contact-form-modal :modal="$modal"/>
</div>
