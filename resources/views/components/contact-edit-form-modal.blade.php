@props(['modal'])
<div wire:ignore.self class="modal fade" id="createEditFormModal" tabindex="-1" aria-labelledby="createEditFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="{{ $modal['action'] }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createEditFormModalLabel">{{ $modal['title'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-sm-6 mb-2">
                            <x-form.input wire:model.defer="name" type="text" name="name" label="Contact Name"
                                placeholder="Mohammad Ali Hemmati" />
                        </div>
                        <div class="col-sm-6 mb-2">
                            <x-form.input wire:model.defer="tel" type="tel" name="tel" label="Phone Number" placeholder="+989126234901" />
                        </div>
                        <div class="col-sm-12 mb-2">
                            <x-form.text wire:model.defer="notes" name="notes" label="Notes" style="height: 120px" placeholder="Extra Notes"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary px-5">{{ $modal['button'] }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        const createEditFormModal = new bootstrap.Modal('#createEditFormModal');
        const createEditFormModalElement = document.getElementById('createEditFormModal');

        createEditFormModalElement.addEventListener('hidden.bs.modal', event => {
            @this.resetCreateEditFormModal();
        })
        
        Livewire.on('showCreateEditForm', () => {
            createEditFormModal.show();
        });
        
        Livewire.on('hideCreateEditFormModal', () => {
            createEditFormModal.hide();
        });
    </script>
@endpush
