<?php

namespace App\Http\Livewire\Business;

use Livewire\Component;

class BusinessComponent extends Component
{
    public $busineSelected,
        $name,
        $direccion,
        $telefonos,
        $faxs,
        $emails,
        $logo,
        $description,
        $category_busine;

    public function render()
    {
        return view('livewire.business.business-component')
            ->extends('layouts.app');
    }
}
