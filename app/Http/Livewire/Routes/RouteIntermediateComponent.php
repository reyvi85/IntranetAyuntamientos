<?php

namespace App\Http\Livewire\Routes;

use App\Models\Route;
use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithFileUploads;

class RouteIntermediateComponent extends Component
{
    use DataModels, WithFileUploads;
    public $route,
        $listaRoutes,
        $ruta_name,
        $ruta_direccion,
        $ruta_description,
        $ruta_imagen,
        $ruta_imagenSelected;

    protected $rules = [
        'ruta_imagen'=>'required|image',
        'ruta_name'=>'required',
        'ruta_direccion'=>'required',
        'ruta_description'=>'required',
        ];
    protected $listeners = ['routeIntermediate'];

    public function mount(Route $route){
        $this->setPatchToUpload('images/rutas');
        $this->route = $route;
        $this->listaRoutes = $route->route_intermediates;
    }
    public function routeIntermediate(Route $route){
        $this->mount($route);
    }

    public function resetProps(){
        $this->resetErrorBag();
        $this->reset(['ruta_name', 'ruta_direccion', 'ruta_description', 'ruta_imagen']);
    }

    public function store(){
        $this->validate();
        $imgRoute = $this->ruta_imagen->store($this->getPatchToUpload(), 'public');
        $this->route->route_intermediates()->create([
            'name'=>$this->ruta_name,
            'address'=>$this->ruta_direccion,
            'description'=>$this->ruta_description,
            'image'=>$imgRoute
        ]);
        $this->emit('routeIntermediate', $this->route->id);
        $this->resetProps();
    }

    public function render()
    {
        return view('livewire.administrator.routes.route-intermediate-component');
    }
}
