<?php

namespace App\Http\Livewire\Routes;

use App\Models\Route;
use App\Models\RouteIntermediate;
use App\Traits\DataModels;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class RouteIntermediateComponent extends Component
{
    use DataModels, WithFileUploads;
    public $route,
        $numRouteAllowed = 10,
        $edit=false,
        $routeSelected,
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
    protected $listeners = ['routeIntermediate', 'render'];

    public function mount(Route $route){
        $this->setPatchToUpload('images/rutas');
        $this->route = $route;
        $this->listaRoutes = $route->route_intermediates;
        $this->resetProps();
    }
    public function routeIntermediate(Route $route){
        $this->mount($route);
    }

    public function resetProps(){
        $this->resetErrorBag();
        $this->reset(['ruta_name', 'ruta_direccion', 'ruta_description', 'ruta_imagen', 'edit', 'routeSelected', 'ruta_imagenSelected']);
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

    public function edit(RouteIntermediate $routeIntermediate){
        $this->edit = true;
        $this->routeSelected = $routeIntermediate->id;
        $this->ruta_name = $routeIntermediate->name;
        $this->ruta_direccion  = $routeIntermediate->address;
        $this->ruta_description = $routeIntermediate->description;
        $this->ruta_imagenSelected = $routeIntermediate->image;
    }

    public function udptRouteIntermediate(RouteIntermediate $routeIntermediate){
        $this->validate([
            'ruta_imagen'=>'nullable|image',
            'ruta_name'=>'required',
            'ruta_direccion'=>'required',
            'ruta_description'=>'required',
        ]);
        if($this->ruta_imagen){
            Storage::disk('public')->delete($routeIntermediate->image);
            $imgRoute = $this->ruta_imagen->store($this->getPatchToUpload(), 'public');
        }else{
            $imgRoute = $routeIntermediate->image;
        }
        $routeIntermediate->fill([
            'name'=>$this->ruta_name,
            'address'=>$this->ruta_direccion,
            'description'=>$this->ruta_description,
            'image'=>$imgRoute
        ])->save();
        $this->emit('render');
        $this->resetProps();
    }

    public function destroy(RouteIntermediate $routeIntermediate){
        Storage::disk('public')->delete($routeIntermediate->image);
        $routeIntermediate->delete();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.administrator.routes.route-intermediate-component');
    }
}
