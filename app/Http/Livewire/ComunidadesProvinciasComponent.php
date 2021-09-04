<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Traits\CommunityProvince;

class ComunidadesProvinciasComponent extends Component
{
    /** Traits */
    use CommunityProvince;

    public $ComunidadId,
        $name,
        $slug,
        $search,
        $listComunidades,
        $listProvincias,
        $idPovincia;

    public function mount(){
        $this->listComunidades = $this->getComunidades();
    }

    public function render()
    {
       // dd(count($this->listComunidades));
        return view('livewire.administrator.comunidades-provincias-component');
    }
}
