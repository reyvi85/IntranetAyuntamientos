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
        $visitantes,
        $residentes,
        $inicio,
        $location_category,

        $listCategory;

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->listCategory = $this->getAllCategoryLocation($this->instancias);
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

    public function updatedCategoryFilter()
    {
      $this->resetPage();
    }

    public function render()
    {
        $locations = $this->getLocations($this->search, $this->instancias, $this->categoryFilter, $this->sort, $this->sortDirection);
        return view('livewire.administrator.locations.location-component', compact('locations'));
    }
}
