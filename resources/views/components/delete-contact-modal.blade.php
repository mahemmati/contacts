<div wire:ignore.self class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="deleteContactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteContactModalLabel">Delete Contact</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Confirm deletion of contact:</p>
                <p>{{ $contact?->name }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button wire:click="destroyContact({{ $contact?->id }})"
                    class="btn btn-danger px-5">Destroy</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // const deleteContactModalElement = document.getElementById('deleteContactModal');
        const deleteContactModal = new bootstrap.Modal('#deleteContactModal');

        // deleteContactModalElement.addEventListener('hidden.bs.modal', event => {
        //     @this.hideModal();
        // })

        Livewire.on('showDeleteContactModal', () => {
            deleteContactModal.show();
        });

        Livewire.on('hideDeleteContactModal', () => {
            deleteContactModal.hide();
        });
    </script>
@endpush
