<?php

namespace App\Http\Livewire\Routes;

use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RoutesComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;

    public
        $routeSelected,
        $imageSelected,
        $search,
        $listCategory,

        $name,
        $description,
        $imagen,
        $state,
        $price,
        $inicio_ruta_name,
        $inicio_ruta_direccion,
        $inicio_ruta_description,
        $inicio_ruta_imagen,
        $fin_ruta_name,
        $fin_ruta_direccion,
        $fin_ruta_description,
        $fin_ruta_imagen,
        $instance_id,
        $route_category_id;

    protected $listeners = ['categoryUDPT'];

    public function mount(){

    }

    public function categoryUDPT(){
        /** Actualizar lista de categorias*/
    }



    public function render()
    {
        return view('livewire.administrator.routes.routes-component');
    }
}
