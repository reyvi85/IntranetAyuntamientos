<?php

namespace App\Http\Livewire\Locations;

use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LocationComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['addCategoryLocation'];

    public $search, $locationSelected, $categorySelected, $categoryFilter,
        $name,
        $description,
        $ubicacion,
        $telefono,
        $web,
        $image,
        $imageLocation,
        $visitantes = false,
        $residentes = false,
        $inicio = false,
        $location_category,

        $listCategory, $listCategoryForAdd;

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->listCategory = $this->getAllCategoryLocation($this->instancias);
        $this->listCategoryForAdd = $this->listCategory;
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
    }

    public function resetProps(){
        $this->reset(['name', 'description', 'ubicacion', 'telefono', 'web', 'image', 'imageLocation', 'visitantes', 'residentes', 'inicio', 'location_category', 'modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->setConfigModal();
        $this->resetProps();
    }


    public function render()
    {
        $locations = $this->getLocations($this->search, $this->instancias, $this->categoryFilter, $this->sort, $this->sortDirection);
        return view('livewire.administrator.locations.location-component', compact('locations'));
    }
}
