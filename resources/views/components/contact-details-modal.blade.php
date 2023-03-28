<div wire:ignore.self class="modal fade" id="contactDetailsModal" tabindex="-1" aria-labelledby="contactDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="contactDetailsModalLabel">Contact details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Name:</p>
                <p class="fw-bold">{{ $contact?->name }}</p>
                <p class="mb-0">Number:</p>
                <p class="fw-bold">{{ $contact?->tel }}</p>
                <p class="fw-bold mb-0">Notes:</p>
                <p>{{ $contact?->notes }}</p>
            </div>
            <div class="modal-footer">
                <button wire:click="deleteContact({{ $contact?->id }})"
                    class="btn btn-outline-danger px-4" data-bs-dismiss="modal">Delete</button>
                <button wire:click="editContact({{ $contact?->id }})"
                    class="btn btn-outline-primary px-4" data-bs-dismiss="modal">Edit</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // const deleteContactModalElement = document.getElementById('deleteContactModal');
        const contactDetailsModal = new bootstrap.Modal('#contactDetailsModal');

        // deleteContactModalElement.addEventListener('hidden.bs.modal', event => {
        //     @this.hideModal();
        // })

        Livewire.on('showContactDetailsModal', () => {
            contactDetailsModal.show();
        });

        // Livewire.on('hideDeleteContactModal', () => {
        //     deleteContactModal.hide();
        // });
    </script>
@endpush
