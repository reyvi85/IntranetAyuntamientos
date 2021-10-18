<?php

namespace App\Http\Livewire\Business;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination,
    Livewire\WithFileUploads;

class BusinessComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $busineSelected,
        $search=null, $categorySelected=null, $instanceSelected=null,

        $listInstances,
        $listCategoryBusiness,

        $name,
        $direccion,
        $telefono,
        $fax,
        $email,
        $logo,
        $description,
        $urlWeb,
        $category_busine,
        $instance_busine,
        $indentificadorLogo;

    protected $rules = [
        'name'=>'required',
        'direccion'=>'required',
        'telefono'=>'required',
        'fax'=>'required',
        'email'=>'required|email',
        'description'=>'required',
        'urlWeb'=>'required|url',
        'logo'=>'required|image|max:1024',
        'category_busine'=>'required',
        'instance_busine'=>'required',

    ];

    public function mount()
    {
        $this->indentificadorLogo = rand();
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

    public function add(){

    }

    public function store(){
        $this->validate();
    }

    public function render()
    {

        $listBusiness = $this->getBusinessFiltered($this->search, $this->categorySelected, $this->instanceSelected);
        return view('livewire.administrator.business-component', compact('listBusiness'))
            ->extends('layouts.app');
    }
}
