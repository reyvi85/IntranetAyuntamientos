<?php

namespace App\Http\Livewire;

use App\Traits\Helper;
use Livewire\Component;

class MenuAccessModulesComponent extends Component
{
    use Helper;
    public $modulos;

    public function mount(){
        $this->modulos = $this->getOptionMenu();
    }

    public function render()
    {
        return view('livewire.menu-access-modules-component');
    }
}
