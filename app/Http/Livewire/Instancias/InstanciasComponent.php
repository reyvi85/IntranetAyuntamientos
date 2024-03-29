<?php

namespace App\Http\Livewire\Instancias;

use App\Models\Instance;
use App\Traits\DataModelsComunityProvinces;
use App\Traits\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Traits\DataModels;
use App\Traits\DataModelsInstances;
class InstanciasComponent extends Component
{
    use DataModels, Helper, DataModelsInstances,DataModelsComunityProvinces ,WithPagination, WithFileUploads;

    public $name, $description, $imagen,
        $instanceSelected,
        $municipio,
        $barrio,
        $postal_code,
        $key,

        $modulos,
        $lat,
        $lng,
        $color_title = '#000000',
        $color_sub_title = '#000000',
        $background_color_dark = '#000000',
        $background_color_dark_plus = '#000000',
        $background_color_light = '#000000',

        $listaModulos,
        $imagenSelected,
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
        'description'=>'required',
        'imagen'=>'required|image',
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
        $this->setPatchToUpload('images/instancias');
    }

    public function render()
    {
        $instanciasList = $this->getInstancias($this->search);
        $comunidades = $this->getCommunity();
        return view('livewire.administrator.instancias-component', compact('instanciasList','comunidades'))
            ->extends('layouts.app');
    }

    public function resetProps(){
        $this->reset(['instanceSelected',
            'name',
            'selectedCommunity',
            'selectedProvince',
            'provincias',
            'municipio',
            'barrio',
            'postal_code','key', 'modulos', 'description', 'imagen',
            'color_title',
            'color_sub_title',
            'background_color_dark',
            'background_color_dark_plus',
            'background_color_light',
            'imagenSelected']);
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
        $img = $this->imagen->store($this->getPatchToUpload(), 'public');
       $inst = Instance::create([
           'name'=>$this->name,
           'description'=>$this->description,
           'imagen'=>$img,
           'province_id'=>$this->selectedProvince ,
           'municipio'=>$this->municipio,
           'barrio'=>$this->barrio,
           'postal_code'=>$this->postal_code,
           'key'=>$this->key,
           'modulos'=>$this->addPermission(),
           'lat'=>$this->lat,
           'lng'=>$this->lng,
           'color_title'=>$this->color_title,
           'color_sub_title'=>$this->color_sub_title,
           'background_color_dark'=>$this->background_color_dark,
           'background_color_dark_plus'=>$this->background_color_dark_plus,
           'background_color_light'=>$this->background_color_light,
       ]);
       $inst->warning_categories()->create([
           'name'=>'Sin clasificar'
       ])->sub_categories()->create([
           'name'=>'Sin clasificar'
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
        $this->description = $instance->description;
        $this->imagenSelected = $instance->imagen;
        $this->municipio = $instance->municipio;
        $this->barrio = $instance->barrio;
        $this->postal_code = $instance->postal_code;
        $this->key = $instance->key;
        $this->color_title = $instance->color_title;
        $this->color_sub_title = $instance->color_sub_title;
        $this->background_color_dark = $instance->background_color_dark;
        $this->background_color_dark_plus = $instance->background_color_dark_plus;
        $this->background_color_light = $instance->background_color_light;
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
            'description'=>'required',
            'imagen'=>'nullable|image',
            'selectedCommunity'=>'required',
            'selectedProvince'=>'required',
            'municipio'=>'required',
            'postal_code'=>'required',
            'key'=>'required|unique:instances,key,'.$instance->id,
        ]);

        if($this->imagen){
            Storage::disk('public')->delete($instance->imagen);
            $img = $this->imagen->store($this->getPatchToUpload(), 'public');
        }else{
            $img = $instance->imagen;
        }

        $instance->fill([
            'name'=>$this->name,
            'description'=>$this->description,
            'imagen'=>$img,
            'province_id'=>$this->selectedProvince ,
            'municipio'=>$this->municipio,
            'barrio'=>$this->barrio,
            'postal_code'=>$this->postal_code,
            'key'=>$this->key,
            'modulos'=>$this->addPermission(),
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'color_title'=>$this->color_title,
            'color_sub_title'=>$this->color_sub_title,
            'background_color_dark'=>$this->background_color_dark,
            'background_color_dark_plus'=>$this->background_color_dark_plus,
            'background_color_light'=>$this->background_color_light,
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
       Storage::disk('public')->delete($instance->imagen);
       $this->resetProps();
       $this->modalModeDestroy = false;
        $this->emit('saveModal');
    }

    public function selectInstance($instance){
        $this->emit('getInstanceSelected', $instance);
    }


}
