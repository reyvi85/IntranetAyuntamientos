<?php

namespace App\Http\Livewire\Ampa;

use App\Traits\DataModelAmpa;
use Livewire\Component;

class AmpaFrontComponent extends Component
{
    use DataModelAmpa;
    public $search, $listAmpa=[];

    public function updatedSearch(){
        if ($this->search == ""){
            $this->listAmpa =[];
        }else{
            $this->listAmpa = $this->getClientAmpa($this->search);
        }
    }

    public function render()
    {
        return view('livewire.front.ampa-front-component')
            ->extends('layouts.appPublic');;
    }
}
