<?php

namespace App\Http\Livewire\Instancias;

use App\Models\Instance;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\DataModels;
class InstanciasComponent extends Component
{
    use DataModels;
    use WithPagination;

    public $name,
        $instanceSelected,
        $municipio,
        $barrio,
        $postal_code,
        $key,
        $selectedCommunity = null,
        $selectedProvince = null,
        $provincias = null,
        $search = null,
        $modalModeDestroy = false,
        $modalConfig = [];

    protected $paginationTheme = 'bootstrap';
    protected $rules =[
        'name'=>'required',
        'selectedCommunity'=>'required',
        'selectedProvince'=>'required',
        'municipio'=>'required',
        'postal_code'=>'required',
        'key'=>'required|unique:instances'
    ];
    protected $messages = [
        'name.required'=>'El Nombre de Instancia es requerido!',
        'selectedCommunity.required'=>'Debe seleccionar una Comunidad!',
        'selectedProvince.required'=>'Debe seleccionar una Provincia!',
        'key.unique'=>'Esta Key Token ya esta en uso!',
        'postal_code.required'=>'El Código postal es requerido'
    ];

    public function mount(){
       $this->modalConfig = [
           'titulo'=>'Crear Instancia',
           'icon'=>'fa-plus-circle',
           'action'=>'add'
       ];
       $this->key = Str::random(64);
      // dd($this->getAllInstancias());
    }

    public function render()
    {
        $instancias = $this->getInstancias($this->search);
        $comunidades = $this->getCommunity();
        return view('livewire.administrator.instancias-component', compact('instancias', 'comunidades'))
            ->extends('layouts.app');
    }

    public function resetProps(){
        $this->reset(['instanceSelected','name', 'selectedCommunity', 'selectedProvince', 'provincias', 'municipio', 'barrio', 'postal_code','key']);
        $this->setConfigModal();
        $this->resetErrorBag();
        $this->generateNewToken();
        $this->emit('saveModal');
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedSelectedCommunity($community_id)
    {
        $this->provincias = $this->getProvince($community_id);
    }


    public function generateNewToken(){
        $this->key = Str::random(64);
    }

    public function storeInstance(){
        $this->validate();
       Instance::create([
           'name'=>$this->name,
           'province_id'=>$this->selectedProvince ,
           'municipio'=>$this->municipio,
           'barrio'=>$this->barrio,
           'postal_code'=>$this->postal_code,
           'key'=>$this->key
       ]);
        $this->resetProps();
       // $this->emit('saveModal');
    }

    public function edit(Instance $instance){
        $this->instanceSelected = $instance->id;
        $this->modalModeDestroy = false;
        $this->setConfigModal('Editar instancia', 'fa-edit','edit');
        $this->selectedCommunity = $instance->province->community->id;
        $this->selectedProvince = $instance->province_id;
        $this->updatedSelectedCommunity($this->selectedCommunity);
        $this->name = $instance->name;
        $this->municipio = $instance->municipio;
        $this->barrio = $instance->barrio;
        $this->postal_code = $instance->postal_code;
        $this->key = $instance->key;
    }

    public function updateInstance(Instance $instance)
    {
        $this->validate([
            'name'=>'required',
            'selectedCommunity'=>'required',
            'selectedProvince'=>'required',
            'municipio'=>'required',
            'postal_code'=>'required',
            'key'=>'required|unique:instances,key,'.$instance->id,
        ]);
        $instance->fill([
            'name'=>$this->name,
            'province_id'=>$this->selectedProvince ,
            'municipio'=>$this->municipio,
            'barrio'=>$this->barrio,
            'postal_code'=>$this->postal_code,
            'key'=>$this->key
        ])->save();
        $this->resetProps();
    }

    public function trashInstance(Instance $instance){
        $this->modalModeDestroy = true;
        $this->name = $instance->name;
        $this->instanceSelected = $instance->id;
        $this->setConfigModal('Eliminar instancia', 'fa-trash','trash');
    }

    public function destroy(Instance $instance){
       $instance->delete();
       $this->resetProps();
       $this->modalModeDestroy = false;
       $this->setConfigModal('Crear Instancia');
    }

    public function selectInstance($instance){
        $this->emit('getInstanceSelected', $instance);
    }


}
