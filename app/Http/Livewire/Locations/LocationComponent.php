<?php

namespace App\Http\Livewire\Locations;

use App\Models\Location;
use App\Models\LocationGallery;
use App\Traits\DataModels;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LocationComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;
    protected $listeners = ['addCategoryLocation',  'getLatitudeForInput',  'getLongitudeForInput'];

    public $search, $locationSelected, $categoryFilter,
        $name,
        $description,
        $ubicacion,
        $telefono,
        $web,
        $image,
        $imageGallery = [],
        $email,
        $imageLocation,
        $visitantes = false,
        $residentes = false,
        $inicio = false,
        $categorySelected,
        $lat,
        $lng,

        $listCategory, $listCategoryForAdd;

    protected $rules = [
        'name'=>'required',
        'description'=>'required',
        'ubicacion'=>'required',
        'telefono'=>'required',
        'web'=>'nullable|url',
        'image'=>'required|image|max:1024',
        'imageGallery.*' => 'nullable|image', // 1MB Max
        'email'=>'nullable|email',
        'categorySelected'=>'required',
        'instanceSelected'=>'required',
    ];

    protected $messages = [
        'name.required'=>'El nombre es requerido!',
        'description.required'=>'La descripción es requerida!',
        'categorySelected.required'=>'Debe seleccionar una categoría!',
        'instanceSelected.required'=>'Debe seleccionar una instancia!',
    ];


    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->listCategory = $this->getAllCategoryLocation($this->instancias);
        $this->listCategoryForAdd = $this->listCategory;
        $this->setPatchToUpload('images/localizaciones');

    }

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

    public function addCategoryLocation(){
        $this->listCategory = $this->getAllCategoryLocation($this->instancias);
        $this->categoryFilter = null;
    }

    public function updatedInstancias()
    {
        $this->listCategory = $this->getAllCategoryLocation($this->instancias);
        $this->categoryFilter = null;
    }

    public function updatedInstanceSelected(){
        $this->listCategoryForAdd = $this->getAllCategoryLocation($this->instanceSelected);
    }

    public function updatedCategoryFilter()
    {
      $this->resetPage();
        $this->listCategory = $this->getAllCategoryLocation($this->instancias);
    }

    public function resetProps(){
        $this->reset(['name', 'description', 'ubicacion', 'telefono', 'web', 'image', 'email','imageLocation', 'visitantes', 'categorySelected', 'residentes', 'inicio', 'modalModeDestroy', 'locationSelected', 'imageGallery']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->setConfigModal();
        $this->resetProps();
        if(auth()->user()->rol =='Super-Administrador'){
            $this->reset('instanceSelected');
        }
        $this->emit('resetGallery');
        $this->emit('initMap', config('maps.lat_default'), config('maps.lng_default'));
    }

    public function store(){
        $this->validate();
        $img = $this->image->store($this->getPatchToUpload(), 'public');
        $location = Location::create([
            'name'=>$this->name,
            'description'=>$this->description,
            'ubicacion'=>$this->ubicacion,
            'telefono'=>$this->telefono,
            'web'=>$this->web,
            'image'=>$img,
            'email'=>$this->email,
            'visitantes'=>$this->visitantes,
            'residentes'=>$this->residentes,
            'inicio'=>$this->inicio,
            'instance_id'=>$this->instanceSelected,
            'location_category_id'=>$this->categorySelected,
            'lat'=>$this->lat,
            'lng'=>$this->lng
        ]);

        $this->emit('addImage', $location);

        $this->emit('saveModal');
        $this->resetProps();
    }



    public function edit(Location $location){
        $this->resetProps();
       // $this->updatedInstanceSelected();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->locationSelected = $location;
        $this->name = $location->name;
        $this->description = $location->description;
        $this->ubicacion = $location->ubicacion;
        $this->telefono = $location->telefono;
        $this->web = $location->web;
        $this->email= $location->email;
        $this->imageLocation = $location->image;
        $this->visitantes = $location->visitantes;
        $this->residentes = $location->residentes;
        $this->inicio = $location->inicio;
        $this->instanceSelected = $location->instance_id;
        $this->categorySelected = $location->location_category_id;
        $this->lat = (is_null($location->lat)?config('maps.lat_default'):$location->lat);
        $this->lng = (is_null($location->lng)?config('maps.lng_default'):$location->lng);
        $this->emit('addImage', $location);
        $this->emit('initMap', $this->lat, $this->lng);
    }

    public function update_location(Location $location){
        $this->validate([
            'name'=>'required',
            'description'=>'required',
            'ubicacion'=>'required',
            'telefono'=>'required',
            'web'=>'nullable|url',
            'email'=>'nullable|email',
            'image'=>'nullable|image|max:1024',
            'categorySelected'=>'required',
            'instanceSelected'=>'required',
        ]);
        if($this->image){
            Storage::disk('public')->delete($location->image);
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $img = $location->image;
        }
        $location->fill([
            'name'=>$this->name,
            'description'=>$this->description,
            'ubicacion'=>$this->ubicacion,
            'telefono'=>$this->telefono,
            'web'=>$this->web,
            'image'=>$img,
            'email'=>$this->email,
            'visitantes'=>$this->visitantes,
            'residentes'=>$this->residentes,
            'inicio'=>$this->inicio,
            'instance_id'=>$this->instanceSelected,
            'location_category_id'=>$this->categorySelected,
            'lat'=>$this->lat,
            'lng'=>$this->lng
        ])->save();

       // $this->_createGellery($location);
        $this->emit('addImage', $location);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function trash(Location $location){
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->locationSelected = $location->id;
        $this->name = $location->name;
    }

    public function destroy(Location $location){
        Storage::disk('public')->delete($location->image);
        $location->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }




    public function render()
    {
        $locations = $this->getLocations($this->search, $this->instancias, $this->categoryFilter, $this->sort, $this->sortDirection);
        return view('livewire.administrator.locations.location-component', compact('locations'));
    }
}
