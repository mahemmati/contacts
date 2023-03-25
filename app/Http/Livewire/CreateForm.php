<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class CreateForm extends Component
{
    public $name = null;
    public $tel = null;
    public $message = null;

    protected $rules = [
        'name' => 'required',
        'tel' => 'required|unique:contacts,tel|size:11',
    ];

    public function updated($prop)
    {
        $this->validateOnly($prop);
    }

    public function storeContact()
    {
        $contact = $this->validate();

        $contact = Contact::create($contact);

        $this->emit('contactAdded', $contact->id);

        $this->message = "Contact Added.";

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = null;
        $this->tel = null;
    }

    public function render()
    {
        return view('livewire.create-form');
    }
}
