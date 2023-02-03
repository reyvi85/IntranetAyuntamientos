<?php

namespace App\Http\Livewire\Routes;

use App\Models\Route;
use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RoutesComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;

    public
        $routeSelected,
        $imageRoute,
        $search,
        $listCategory,
        $categoryFilter,
        $categorySelected,

        $name,
        $description,
        $imagen,
        $state,
        $price,
        $inicio_ruta_name,
        $inicio_ruta_direccion,
        $inicio_ruta_description,
        $inicio_ruta_imagen,
        $inicio_ruta_imagenSelected,
        $fin_ruta_name,
        $fin_ruta_direccion,
        $fin_ruta_description,
        $fin_ruta_imagen,
        $fin_ruta_imagenSelected,
        $instance_id,
        $route_category_id;

    protected $rules = [
        'imagen'=>'required|image',
        'inicio_ruta_imagen'=>'required|image',
        'fin_ruta_imagen'=>'required|image',
        'categorySelected'=>'required',
        'name'=>'required',
        'description'=>'required',
        'price'=>'nullable|numeric',
        'inicio_ruta_name'=>'required',
        'inicio_ruta_direccion'=>'required',
        'inicio_ruta_description'=>'required',
        'fin_ruta_name'=>'required',
        'fin_ruta_direccion'=>'required',
        'fin_ruta_description'=>'required',


     ];

    protected $listeners = ['categoryUDPT'];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->listCategory = $this->getCategoryRoutes();
        $this->setPatchToUpload('images/rutas');
    }

    public function categoryUDPT(){
        $this->listCategory = $this->getCategoryRoutes();
    }

    public function resetProps(){
        $this->reset(['routeSelected','imageRoute','name', 'description', 'imagen', 'price', 'instanceSelected', 'routeSelected', 'categorySelected',
            'inicio_ruta_name', 'inicio_ruta_direccion', 'inicio_ruta_description', 'inicio_ruta_imagen', 'inicio_ruta_imagenSelected',
            'fin_ruta_name', 'fin_ruta_direccion', 'fin_ruta_description', 'fin_ruta_imagen', 'fin_ruta_imagenSelected'
        ]);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
       $this->validate();
        $imgRoute = $this->imagen->store($this->getPatchToUpload(), 'public');
        $imgRouteInicio = $this->inicio_ruta_imagen->store($this->getPatchToUpload(), 'public');
        $imgRouteFin = $this->fin_ruta_imagen->store($this->getPatchToUpload(), 'public');
        $route = Route::create([
            'name'=>$this->name,
            'description'=>$this->description,
            'imagen'=>$imgRoute,
            'price'=>(!is_null($this->price))?$this->price:0,
            'inicio_ruta_name'=>$this->inicio_ruta_name,
            'inicio_ruta_direccion'=>$this->inicio_ruta_direccion,
            'inicio_ruta_description'=>$this->inicio_ruta_description,
            'inicio_ruta_imagen'=>$imgRouteInicio,
            'fin_ruta_name'=>$this->fin_ruta_name,
            'fin_ruta_direccion'=>$this->fin_ruta_direccion,
            'fin_ruta_description'=>$this->fin_ruta_description,
            'fin_ruta_imagen'=>$imgRouteFin,
            'instance_id'=>$this->instanceSelected,
            'route_category_id'=>$this->categorySelected
        ]);
        //$this->resetProps();
        //$this->emit('saveModal');
        $this->edit($route);
    }

    public function edit(Route $route){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->routeSelected = $route->id;
        $this->instanceSelected = $route->instance_id;
        $this->categorySelected = $route->route_category_id;
        $this->name = $route->name;
        $this->description = $route->description;
        $this->imageRoute = $route->imagen;
        $this->inicio_ruta_name = $route->inicio_ruta_name;
        $this->inicio_ruta_direccion = $route->inicio_ruta_direccion;
        $this->inicio_ruta_description = $route->inicio_ruta_description;
        $this->inicio_ruta_imagenSelected = $route->inicio_ruta_imagen;
        $this->fin_ruta_name = $route->fin_ruta_name;
        $this->fin_ruta_direccion = $route->fin_ruta_direccion;
        $this->fin_ruta_description = $route->fin_ruta_description;
        $this->fin_ruta_imagenSelected = $route->fin_ruta_imagen;
        $this->emit('routeIntermediate', $route->id);
    }



    public function render()
    {
        $routes = $this->getAllRoutes($this->search, $this->instancias, $this->categoryFilter);
        return view('livewire.administrator.routes.routes-component', compact('routes'));
    }
}
