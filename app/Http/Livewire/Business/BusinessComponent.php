<?php

namespace App\Http\Livewire\Business;

use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class BusinessComponent extends Component
{
    use DataModels, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $busineSelected,
        $search=null, $categorySelected=null, $instanceSelected=null,

    //   $listBusiness = collect(),
        $listInstances,
        $listCategoryBusiness,

        $name,
        $direccion,
        $telefonos,
        $faxs,
        $emails,
        $logo,
        $description,
        $category_busine;

    public function mount()
    {
        $this->setConfigModal('Añadir Comercio');
        $this->listCategoryBusiness = $this->getAllCategoryBusiness();
        $this->listInstances = $this->getAllInstace();
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedCategorySelected(){
        $this->resetPage();
    }

    public function updatedInstanceSelected(){
        $this->resetPage();
    }

    public function render()
    {
        $listBusiness = $this->getBusinessFiltered($this->search, $this->categorySelected, $this->instanceSelected);
        return view('livewire.administrator.business-component', compact('listBusiness'))
            ->extends('layouts.app');
    }
}
