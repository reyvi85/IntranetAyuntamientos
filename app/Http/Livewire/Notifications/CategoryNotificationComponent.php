<?php

namespace App\Http\Livewire\Notifications;

use App\Models\CategoryNotification;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class CategoryNotificationComponent extends Component
{
    use DataModels, WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name'=>'required',
        'instanceSelected'=>'required'
    ];
    protected $messages =[
        'instanceSelected.required'=>'Debe seleccionar una instancia'
    ];
    public $search, $name, $categorySelected;

    public function mount(){
        $this->resetPage();
       $this->checkInstanceForUser();
       $this->setConfigModal();
    }

    public function resetProps(){
        $this->reset(['name', 'modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        CategoryNotification::create([
            'name'=>$this->name,
            'instance_id'=>$this->instanceSelected
        ]);
        $this->emit('saveModal');
        $this->emit('categoryUDPT');
        $this->resetProps();

    }

    public function edit(CategoryNotification $categoryNotification){
        $this->resetProps();
        $this->setConfigModal('Editar categoría', 'fa-edit', 'edit');
        $this->categorySelected = $categoryNotification->id;
        $this->name = $categoryNotification->name;
        $this->instanceSelected = $categoryNotification->instance_id;
    }

    public function update_category(CategoryNotification $categoryNotification){
        $this->validate();
        $categoryNotification->fill([
            'name'=>$this->name,
            'instance_id'=>$this->instanceSelected
        ])->save();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function trash(CategoryNotification $categoryNotification){
        $this->setConfigModal('Eliminar categoría', 'fa-trash', 'trash');
        $this->name = $categoryNotification->name;
        $this->categorySelected = $categoryNotification->id;
        $this->modalModeDestroy = true;
    }

    public function destroy(CategoryNotification $categoryNotification){
        $categoryNotification->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function render()
    {
        $listCategoryNotification = $this->getCategoryNotification($this->search,$this->instancias, $this->sort, $this->sortDirection);
        return view('livewire.administrator.notifications.category-notification-component', compact('listCategoryNotification'));
    }
}
