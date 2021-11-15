<?php

namespace App\Http\Livewire\Instancias;

use App\Models\Instance;
use App\Traits\Helper;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\DataModels;
use Illuminate\Support\Facades\Route;
class InstanciasComponent extends Component
{
    use DataModels, Helper;
    use WithPagination;

    public $name,
        $instanceSelected,
        $municipio,
        $barrio,
        $postal_code,
        $key,

        $modulos,
        $lat,
        $lng,
        $listaModulos,

        $selectedCommunity = null,
        $selectedProvince = null,
        $provincias = null,
        $search = null;
        //$modalModeDestroy = false;

    protected $paginationTheme = 'bootstrap';


    protected $listeners = [
        'getLatitudeForInput',  'getLongitudeForInput'
    ];


    public function getLatitudeForInput($value)
    {
        if(!is_null($value))
            $this->lat = $value;
    }
    public function getLongitudeForInput($value)
    {
        if(!is_null($value))
            $this->lng = $value;
    }

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
        $this->listaModulos = $this->modulosApp();
        $this->modulos = [];
       $this->setConfigModal('Crear Instancia');
       $this->key = Str::random(64);
    }

    public function render()
    {
        $instanciasList = $this->getInstancias($this->search);
        $comunidades = $this->getCommunity();
        return view('livewire.administrator.instancias-component', compact('instanciasList','comunidades'))
            ->extends('layouts.app');
    }

    public function resetProps(){
        $this->reset(['instanceSelected','name', 'selectedCommunity', 'selectedProvince', 'provincias', 'municipio', 'barrio', 'postal_code','key', 'modulos']);
        $this->setConfigModal();
        $this->resetErrorBag();
        $this->generateNewToken();

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

    public function add()
    {
        $this->resetProps();
        $this->emit('initMap', config('maps.lat_default'), config('maps.lng_default'));
    }

    private function addPermission(){
        $permission=[];
        if($this->modulos){
            foreach($this->modulos as $mod){
                if ($mod){
                    $permission[] = $mod;
                }
            }
        }
        return $permission;
    }

    public function storeInstance(){
        $this->validate();

       Instance::create([
           'name'=>$this->name,
           'province_id'=>$this->selectedProvince ,
           'municipio'=>$this->municipio,
           'barrio'=>$this->barrio,
           'postal_code'=>$this->postal_code,
           'key'=>$this->key,
           'modulos'=>$this->addPermission(),
           'lat'=>$this->lat,
           'lng'=>$this->lng
       ]);
        $this->resetProps();
        $this->emit('saveModal');
    }

    public function edit(Instance $instance){
       $this->resetProps();
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
        $this->lat = (is_null($instance->lat)?config('maps.lat_default'):$instance->lat);
        $this->lng = (is_null($instance->lng)?config('maps.lng_default'):$instance->lng);

       // dd($this->lat);

        if (is_array($instance->modulos) && count($instance->modulos)){
            foreach ($instance->modulos as $value){
                $this->modulos[$value]=$value;
            }
        }
        $this->emit('initMap', $this->lat, $this->lng);
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
            'key'=>$this->key,
            'modulos'=>$this->addPermission(),
            'lat'=>$this->lat,
            'lng'=>$this->lng
        ])->save();
        $this->resetProps();
        $this->emit('saveModal');
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
        $this->emit('saveModal');
    }

    public function selectInstance($instance){
        $this->emit('getInstanceSelected', $instance);
    }


}
