<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class IndexTable extends Component
{
    public $contacts = null;
    public $addedContactId = 0;

    protected $listeners = ['contactAdded' => 'queryContacts'];

    public function queryContacts($addedContactId = 0)
    {
        $this->addedContactId = $addedContactId;
        $this->contacts = Contact::query()
            ->latest()
            ->get();
    }

    public function mount()
    {
        $this->queryContacts();
    }

    public function deleteContact($contactId)
    {
        if ($contact = Contact::find($contactId))
            $contact->delete();

        $this->queryContacts();
    }

    public function render()
    {
        return view('livewire.index-table');
    }
}
