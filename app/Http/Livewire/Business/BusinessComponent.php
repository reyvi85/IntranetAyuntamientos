<?php

namespace App\Http\Livewire\Business;

use App\Models\Busine;
use App\Scopes\UserInstanceScope;
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
        $search=null, $categorySelected=null,
        $sort='id',
        $sortDirection='desc',
        $imgBussines,

      //  $listInstances,
        $listCategoryBusiness,

        $name,
        $direccion,
        $telefono,
        $email,
        $logo,
        $description,
        $urlWeb,
        $category_busine,
        $indentificadorLogo;


    protected function rules(){
            return [
                'name'=>'required',
                'direccion'=>'required',
                'telefono'=>'nullable',
                'email'=>'nullable|email',
                'description'=>'required',
                'urlWeb'=>'required|url',
                'logo'=>'nullable|image|max:1024|mimes:jpg,png',
                'category_busine'=>'required',
                'instanceSelected'=>'required',
            ];
    }

    protected function messages(){
        return [
            'category_busine.required'=>'Debe seleccionar una categoría!',
            'instanceSelected.required'=>'Debe seleccionar una instancia!',
            'logo.mimes'=>'Debe seleccionar una imagen JPG o PNG!'
        ];
    }

    public function mount()
    {
        $this->checkInstanceForUser();
        $this->indentificadorLogo = rand();
        $this->setConfigModal('Añadir Comercio');
        $this->listCategoryBusiness = $this->getAllCategoryBusiness();
       // $this->listInstances = $this->getAllInstace();

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
        $this->reset(['name', 'direccion', 'telefono', 'email', 'description', 'urlWeb', 'logo', 'category_busine', 'modalModeDestroy', 'imgBussines']);
        $this->resetErrorBag();

    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        if($this->logo){
            $img = $this->logo->store('images/business', 'public');
        }else{
            $img=null;
        }
        Busine::create([
            'name'=>$this->name,
            'direccion'=>$this->direccion,
            'telefono'=>$this->telefono,
            'email'=>$this->email,
            'description'=>$this->description,
            'url_web'=>$this->urlWeb,
            'logo'=>$img,
            'category_busine_id'=>$this->category_busine,
            'instance_id'=>$this->instanceSelected,
            'slug'=>Str::slug($this->name)
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(Busine $busine){
        $this->setConfigModal('Editar comercio', 'fa-edit', 'edit');
        $this->resetProps();
        $this->busineSelected = $busine->id;
        $this->name = $busine->name;
        $this->direccion = $busine->direccion;
        $this->telefono = $busine->telefono;
        $this->email = $busine->email;
        $this->description = $busine->description;
        $this->urlWeb = $busine->url_web;
        $this->imgBussines = (is_null($busine->logo)?'images/no-image.jpg':$busine->logo);
        $this->category_busine = $busine->category_busine_id;
        $this->instanceSelected = $busine->instance_id;
    }

    public function update(Busine $busine){
        $this->validate();
        if($this->logo){
            Storage::disk('public')->delete($busine->logo);
            $img = $this->logo->store('images/business', 'public');
        }else{
            $img = $busine->logo;
        }

        $busine->fill([
            'name'=>$this->name,
            'direccion'=>$this->direccion,
            'telefono'=>$this->telefono,
            'email'=>$this->email,
            'description'=>$this->description,
            'url_web'=>$this->urlWeb,
            'logo'=>$img,
            'category_busine_id'=>$this->category_busine,
            'instance_id'=>$this->instanceSelected,
            'slug'=>Str::slug($this->name)
        ])->save();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function trash(Busine $busine){
        $this->busineSelected = $busine->id;
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->name = $busine->name;
    }

    public function destroy(Busine $busine){
        Storage::disk('public')->delete($busine->logo);
        $busine->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function render()
    {
        $listBusiness = $this->getBusinessFiltered($this->search, $this->categorySelected, $this->instancias, $this->sort, $this->sortDirection);
        return view('livewire.administrator.business-component', compact('listBusiness'))
            ->extends('layouts.app');
    }
}
