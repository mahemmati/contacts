<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTable extends Component
{
    use WithPagination;

    public $contactOfInterest = null;

    public $modal = ['action' => null, 'title' => null, 'button' => null];
    public $name, $tel, $notes;
    public $search;
    public $sortColumn, $sortDir;

    public $addedContactId = 0;

    protected $paginationTheme = 'bootstrap';


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

    protected $queryString = [
        'search' => ['except' => ''],
        'sortColumn' => ['except' => ''],
        'sortDir' => ['except' => ''],
    ];

    public function mount()
    {
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.index-table', [
            'contacts' => Contact::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('tel', 'like', '%' . $this->search . '%')
                ->orWhere('notes', 'like', '%' . $this->search . '%')
                ->when($this->sortColumn, function (Builder $query) {
                    $query->orderBy($this->sortColumn, $this->sortDir);
                })
                ->latest()
                ->paginate(8)
        ]);
    }

    public function toggleSort($column)
    {
        if ($this->sortColumn != $column) {
            $this->sortColumn = $column;
            $this->sortDir = 'asc';
        } elseif ($this->sortDir == 'asc') {
            $this->sortDir = 'desc';
        } else {
            $this->sortDir = 'asc';
        }
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
        if (!$this->contactOfInterest = Contact::find($id)) redirect()->route('contacts');

        $this->resetCreateEditFormModal();

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
        $this->showContactDetailsModal();
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
