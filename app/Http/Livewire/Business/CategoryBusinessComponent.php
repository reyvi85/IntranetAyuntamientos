<?php

namespace App\Http\Livewire\Business;

use App\Models\CategoryBusine;
use App\Traits\DataModelsBusiness;
use Illuminate\Support\Str;
use Livewire\Component,
    App\Traits\DataModels;

class CategoryBusinessComponent extends Component
{
    use DataModels, DataModelsBusiness;
    public $name, $slug, $categorySelected = null ,$search = null, $sort = 'id', $direction, $listCategory;

    protected $rules = [
        'name'=>'required|unique:category_busines'
    ],
    $messages = [
        'name.required'=>'El Nombre de Categoría es requerido!',
        'name.unique'=>'Esta Nombre de Categoría ya está en uso!'
    ];

    public function mount(){
        $this->setConfigModal('Añadir categoría', 'fa-plus-circle', 'add');
    }

    private function resetProps(){
        $this->reset(['name', 'categorySelected']);
        $this->modalModeDestroy = false;
        $this->emit('saveModal');
    }

    public function add(){
        $this->resetProps();
        $this->resetErrorBag();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        CategoryBusine::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->name)
        ]);
        $this->resetProps();
    }

    public function edit(CategoryBusine $categoryBusine){
        $this->setConfigModal('Editar categoría', 'fa-edit', 'edit');
        $this->modalModeDestroy = false;
        $this->categorySelected = $categoryBusine->id;
        $this->name = $categoryBusine->name;
    }

    public function update(CategoryBusine $categoryBusine){
        $this->validate([
            'name'=>'required|unique:category_busines,name,'.$categoryBusine->id
        ]);
        $categoryBusine->fill([
            'name'=>$this->name,
            'slug'=>Str::slug($this->name),
        ])->save();
        $this->resetProps();
    }

    public function trash(CategoryBusine $categoryBusine){
        $this->modalModeDestroy = true;
        $this->name = $categoryBusine->name;
        $this->categorySelected = $categoryBusine->id;
        $this->setConfigModal('Eliminar Categoría', 'fa-trash','trash');
    }

    public function destroy(CategoryBusine $categoryBusine){
        $categoryBusine->delete();
        $this->resetProps();
        $this->modalModeDestroy = false;
    }


    public function render()
    {
        $this->listCategory = $this->getCategoryBusiness($this->search, $this->sort, $this->sortDirection);
        return view('livewire.administrator.business.category-business-component');
    }
}
