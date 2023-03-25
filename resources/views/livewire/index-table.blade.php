<div>
    <h1 class="h4">Your Contacts</h1>
    @if ($contacts->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr @class(['table-success' => $contact->id == $addedContactId])>
                        <th scope="row">{{ $contact->id }}</th>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->tel }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">Edit</a>
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
    <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirmDeleteLabel">Deletion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal" wire:click="">Delete</button>
                    {{-- <form wire:submit.prevent="deleteContact">
                        <input name="id" type="hidden" value="0">
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
    <script>
        const confirmDelete = document.getElementById('confirmDelete')
        confirmDelete.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const contactId = button.getAttribute('data-bs-contact')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            const modalTitle = confirmDelete.querySelector('.modal-title')
            const modalBodyInput = confirmDelete.querySelector('.modal-body input')
            const modalConfirmButton = confirmDelete.querySelector('.modal-footer button.btn-danger')

            modalConfirmButton.setAttribute('wire:click', 'deleteContact(' + contactId + ')')
            // modalConfirmButton.value = contactId
        })
    </script>
</div>
