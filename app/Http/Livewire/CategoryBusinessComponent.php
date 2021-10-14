<?php

namespace App\Http\Livewire;

use App\Models\CategoryBusine;
use Livewire\Component,
    App\Traits\DataModels;

class CategoryBusinessComponent extends Component
{
    use DataModels;
    public $name, $slug, $search = null, $sort = 'id', $direction, $listCategory;

    public function mount(){
        $this->setConfigModal('Añadir categoría', 'fa-plus-circle', 'add');
    }

    public function edit(CategoryBusine $categoryBusine){
        $this->setConfigModal('Editar categoría', 'fa-edit', 'edit');
        $this->name = $categoryBusine->name;
    }

    public function update(CategoryBusine $categoryBusine){

    }

    public function render()
    {
        $this->listCategory = $this->getCategoryBusiness($this->search, $this->sort, $this->sortDirection);
        return view('livewire.administrator.category-business-component')
            ->extends('layouts.app');
    }
}
