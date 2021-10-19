<?php

namespace App\Http\Livewire\Business;

use App\Models\Busine;
use App\Scopes\BusinessScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination,
    Livewire\WithFileUploads;

class BusinessComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $busineSelected, $modalModeDestroy = false,
        $search=null, $categorySelected=null, $instanceSelected=null,
        $sort='id',
        $sortDirection='desc',

        $listInstances,
        $listCategoryBusiness,

        $name,
        $direccion,
        $telefono,
        $email,
        $logo,
        $description,
        $urlWeb,
        $category_busine,
        $instance_busine,
        $indentificadorLogo;


    protected function rules(){
        if(Auth::user()->rol != 'Super-Administrador'){
            return [
                'name'=>'required',
                'direccion'=>'required',
                'telefono'=>'nullable',
                'email'=>'nullable|email',
                'description'=>'required',
                'urlWeb'=>'required|url',
                'logo'=>'required|image|max:1024',
                'category_busine'=>'required',
                'instance_busine'=>'required|in:'.Auth::user()->instances->pluck('id')->implode(','),
            ];
        }else{
            return [
                'name'=>'required',
                'direccion'=>'required',
                'telefono'=>'nullable',
                'email'=>'nullable|email',
                'description'=>'required',
                'urlWeb'=>'required|url',
                'logo'=>'required|image|max:1024',
                'category_busine'=>'required',
                'instance_busine'=>'required',
            ];
        }
    }

    protected function messages(){
        return [
            'category_busine.required'=>'Debe seleccionar una categoría!',
            'instance_busine.required'=>'Debe seleccionar una instancia!'
        ];
    }

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

    public function resetProps(){
        $this->reset(['name', 'direccion', 'telefono', 'email', 'description', 'urlWeb', 'logo', 'category_busine', 'instance_busine', 'modalModeDestroy']);
        $this->resetErrorBag();

    }

    public function add(){
        $this->resetProps();
    }

    public function store(){
        $this->validate();
        $img = $this->logo->store('images/business');
        Busine::create([
            'name'=>$this->name,
            'direccion'=>$this->direccion,
            'telefono'=>$this->telefono,
            'email'=>$this->email,
            'description'=>$this->description,
            'url_web'=>$this->urlWeb,
            'logo'=>$img,
            'category_busine_id'=>$this->category_busine,
            'instance_id'=>$this->instance_busine,
            'slug'=>Str::slug($this->name)
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function render()
    {

        $listBusiness = $this->getBusinessFiltered($this->search, $this->categorySelected, $this->instanceSelected, $this->sort, $this->sortDirection);
        return view('livewire.administrator.business-component', compact('listBusiness'))
            ->extends('layouts.app');
    }
}
