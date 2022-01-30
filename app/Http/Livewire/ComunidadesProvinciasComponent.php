<?php

namespace App\Http\Livewire;

use App\Models\Community;
use App\Models\Instance;
use App\Models\Province;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Traits\DataModels;

class ComunidadesProvinciasComponent extends Component
{
    /** Traits */
    use DataModels;

    public
        $name,
        $search,

        $sort = 'id',
        $sortDirection = 'desc',

        //$modalModeDestroy = false,


        $comunidadID,
        $provinciaID,

        $idProvincia;


    protected $messages = [
        'name.required'=> 'El campo nombre no puede estar vacío!',
        'name.unique'=> 'El campo nombre ya está en uso!'
    ];

   // protected $listeners = ['addProvincia'=>'render'];

    public function mount()
    {
        $this->setConfigModal('Crear Comunidad', null, 'add-comunidad');
        $this->idProvincia = 0;
        $this->model = null;
    }

    public function render()
    {
        $comunidades = $this->getComunidades($this->search, $this->sort, $this->sortDirection);
        return view('livewire.administrator.comunidades-provincias-component', compact('comunidades'))
            ->extends('layouts.app');
    }


    public function saveFormModal(){
        $this->reset(['name', 'comunidadID', 'provinciaID']);
        $this->emit('saveModal'); // Close model to using to jquery
    }


    /**  C O M U N I D A D E S **/
     public function createComunidad(){
        $this->resetErrorBag();
        $this->setConfigModal('Crear Comunidad', 'fa-plus-circle', 'add-comunidad');
        $this->reset(['name']);
    }

    public function storeComunidad(){
        $this->validate([
            'name'=>'required|unique:communities',
        ]);
        Community::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->name)
        ]);
        $this->saveFormModal();
    }


    public function editComunidad(Community $community){
        $this->resetErrorBag();
        $this->setConfigModal('Editar Comunidad', 'fa-edit', 'edit-comunidad');
        $this->name = $community->name;
        $this->comunidadID = $community->id;
    }

    public function updateComunidad(Community $community){
        $this->validate([
            'name'=>'required|unique:communities,name,'.$community->id,
        ]);
        $community->fill([
            'name'=>$this->name,
            'slug'=>Str::slug($this->name)
        ])->save();
        $this->saveFormModal();
    }

    public function trashComunidad(Community $community){
        $this->setConfigModal('Eliminar Comunidad', 'fa-trash', 'trash-comunidad');
        $this->name = $community->name;
        $this->modalModeDestroy = true;
        $this->comunidadID = $community->id;
    }

    public function destroyComunidad(Community $community){
        $community->delete();
        $this->modalModeDestroy = false;
        $this->saveFormModal();
    }

    /** P R O V I N C I A S*/
    public function createProvincia($id){
        $this->resetErrorBag();
        $this->setConfigModal('Crear Provincia', 'fa-plus-circle', 'add-prov');
        $this->comunidadID = $id;
        $this->reset(['name']);
    }

    public function storeProvincia(Community $community)
    {
        $this->validate([
            'name'=>'required|unique:provinces',
        ]);
        $q = $community->provincias()->create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->name)
        ]);
        $this->idProvincia = $q->community_id;
        $this->saveFormModal();
    }

    public function editProvincia(Province $province)
    {
        $this->resetErrorBag();
        $this->setConfigModal('Editar Provincia', 'fa-edit', 'edit-prov');
        $this->name = $province->name;
        $this->provinciaID = $province->id;
    }

    public function updateProvincia(Province $province)
    {
        $this->validate([
            'name'=>'required|unique:provinces,name,'.$province->id,
        ]);
        $province->fill([
            'name'=>$this->name,
            'slug'=>Str::slug($this->name)
        ])->save();
        $this->saveFormModal();
    }
    public function trashProvincia(Province $province){
        $this->setConfigModal('Eliminar Provincia', 'fa-trash', 'trash-prov');
        $this->name = $province->name;
        $this->modalModeDestroy = true;
        $this->provinciaID = $province->id;
    }

    public function destroyProvincia(Province $province){
        $province->delete();
        $this->modalModeDestroy = false;
        $this->saveFormModal();
    }

}
