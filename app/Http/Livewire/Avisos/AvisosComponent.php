<?php

namespace App\Http\Livewire\Avisos;

use Livewire\Component;

class AvisosComponent extends Component
{
    public function render()
    {
        return view('livewire.administrator.avisos.avisos-component')
            ->extends('layouts.app');
    }
}
