<?php

namespace App\Http\Livewire\Events;

use App\Models\EventCategory;
use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryEventComponent extends Component
{
    use DataModels, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $categorySelected, $search;

    protected $rules =[
        'name'=>'required|unique:event_categories,name',
    ];

    public function mount(){
        $this->setConfigModal();
    }

    public function resetProps(){
        $this->reset(['name', 'categorySelected', 'modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        EventCategory::create([
           'name'=>$this->name
        ]);
        $this->emit('saveModal');
        $this->emit('addCategoryEvents');
        $this->resetProps();
    }

    public function edit(EventCategory $eventCategory){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->categorySelected = $eventCategory->id;
        $this->name = $eventCategory->name;
    }

    public function update_category(EventCategory $eventCategory){
        $this->validate([
            'name'=>'required|unique:event_categories,name,'.$eventCategory->id,
        ]);
        $eventCategory->fill([
            'name'=>$this->name
        ])->save();
        $this->resetProps();
        $this->emit('saveModal');
        $this->emit('addCategoryEvents');
    }

    public function trash(EventCategory $eventCategory){
        $this->categorySelected = $eventCategory->id;
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->name = $eventCategory->name;
    }

    public function destroy(EventCategory $eventCategory){
        $eventCategory->delete();
        $this->emit('saveModal');
        $this->emit('addCategoryEvents');
    }

    public function render()
    {
        $listCategory = $this->getAllCategoryEvents($this->search);
        return view('livewire.administrator.events.category-event-component', compact('listCategory'));
    }
}
