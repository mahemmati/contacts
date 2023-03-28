<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Validation\Rule;
use Livewire\Component;

class IndexTable extends Component
{
    public $contactOfInterest = null;

    public $modal = ['action' => null, 'title' => null, 'button' => null];
    public $name, $tel, $notes;
    public $search;

    public $contacts = null;
    public $addedContactId = 0;

    protected function rules()
    {
        return [
            'name' => 'required',
            'tel' => [
                'required',
                'size:11',
                Rule::unique('contacts')->ignore($this->contactOfInterest?->id)
            ],
            'notes' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->queryContacts();
    }

    public function queryContacts()
    {
        $this->contacts = Contact::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('tel', 'like', '%' . $this->search . '%')
            ->orWhere('notes', 'like', '%' . $this->search . '%')
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.index-table');
    }

    public function updatedSearch($newValue)
    {
        $this->queryContacts();
    }

    public function createContact()
    {
        $this->modal['action'] = 'storeContact';
        $this->modal['title'] = 'Create New Contact';
        $this->modal['button'] = 'Store';

        $this->showCreateEditFormModal();
    }

    public function storeContact()
    {
        $this->reset('contactOfInterest');
        $validated = $this->validate();
        $this->contactOfInterest = Contact::create($validated);
        $this->queryContacts();
        $this->hideCreateEditFormModal();
    }

    public function showContact($id)
    {
        if (!$this->contactOfInterest = Contact::find($id))
            redirect()->route('contacts');

        $this->showContactDetailsModal();
    }

    public function editContact($id)
    {
        if (!$this->contactOfInterest = Contact::find($id))
            redirect()->route('contacts');

        $this->name = $this->contactOfInterest->name;
        $this->tel = $this->contactOfInterest->tel;
        $this->notes = $this->contactOfInterest->notes;

        $this->modal['action'] = "updateContact()";
        $this->modal['title'] = 'Edit Contact';
        $this->modal['button'] = 'Update';

        $this->showCreateEditFormModal();
    }

    public function updateContact()
    {
        if (!$this->contactOfInterest)
            redirect()->route('contacts');

        if (!$this->contactOfInterest->update($this->validate()))
            redirect()->route('contacts');

        $this->hideCreateEditFormModal();
    }

    public function deleteContact($id)
    {
        if (!$this->contactOfInterest = Contact::find($id))
            redirect()->route('contacts');

        $this->showDeleteModal();
    }

    public function destroyContact()
    {
        if (!$this->contactOfInterest)
            redirect()->route('contacts');

        $this->contactOfInterest->delete();
        $this->queryContacts();

        $this->hideDeleteModal();

        $this->reset('contactOfInterest');
    }

    public function showContactDetailsModal()
    {
        $this->emit('showContactDetailsModal');
    }

    public function showCreateEditFormModal()
    {
        $this->emit('showCreateEditForm');
    }

    public function hideCreateEditFormModal()
    {
        $this->emit('hideCreateEditFormModal');
        $this->resetCreateEditFormModal();
    }

    public function resetCreateEditFormModal()
    {
        $this->reset('modal');
        $this->reset(['name', 'tel', 'notes']);
        $this->resetValidation();
    }

    public function showDeleteModal()
    {
        if (!$this->contactOfInterest)
            redirect()->route('contacts');

        $this->emit('showDeleteContactModal');
    }

    public function hideDeleteModal()
    {
        $this->emit('hideDeleteContactModal');
    }
}
