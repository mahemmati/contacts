<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Validation\Rule;
use Livewire\Component;

class IndexTable extends Component
{
    public $contactOfInterest = null;

    
    public $modal = ['action' => null, 'title' => null, 'button' => null];
    public $name, $tel;
    
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
        ];
    }

    public function mount()
    {
        $this->queryContacts();
    }

    public function render()
    {
        return view('livewire.index-table');
    }

    public function createContact()
    {
        $this->modal['action'] = 'storeContact';
        $this->modal['title'] = 'Create New Contact';
        $this->modal['button'] = 'Store';
    }

    public function storeContact()
    {
        $validated = $this->validate();
        $this->contactOfInterest = Contact::create($validated);
        $this->queryContacts();
        $this->hideModal();
    }

    public function editContact($id)
    {
        if (!$contact = Contact::find($id))
            redirect()->route('contacts');

        $this->name = $contact->name;
        $this->tel = $contact->tel;

        $this->modal['action'] = "updateContact($id)";
        $this->modal['title'] = 'Edit Contact';
        $this->modal['button'] = 'Update';

        $this->showModal();
    }

    public function updateContact($id)
    {
        if (!$this->contactOfInterest = Contact::find($id))
            redirect()->route('contacts');

        if (!$this->contactOfInterest->update($this->validate()))
            redirect()->route('contacts');

        $this->queryContacts();
        $this->hideModal();
    }

    public function showModal()
    {
        $this->emit('showContactFormModal');
    }

    public function resetModal()
    {
        $this->modal = ['action' => null, 'title' => null, 'button' => null];
        $this->name = null;
        $this->tel = null;
        $this->resetValidation();
    }

    public function hideModal()
    {
        $this->emit('hideContactFormModal');
        $this->resetModal();
    }

    public function queryContacts()
    {
        $this->contacts = Contact::latest()->get();
    }

    public function deleteContact($contactId)
    {
        if ($contact = Contact::find($contactId))
            $contact->delete();

        $this->queryContacts();
    }
}
