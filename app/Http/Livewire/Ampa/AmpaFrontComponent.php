<?php

namespace App\Http\Livewire\Ampa;

use App\Traits\DataModelAmpa;
use Livewire\Component;

class AmpaFrontComponent extends Component
{
    use DataModelAmpa;
    public $search, $listAmpa=[], $is_empty = false;

    public function updatedSearch(){
        if ($this->search == ""){
            $this->listAmpa =[];
            $this->is_empty = false;
        }else{
            $this->listAmpa = $this->getClientAmpa($this->search);
            $this->is_empty = true;
        }
    }

    public function render()
    {
        return view('livewire.front.ampa-front-component')
                    ->extends('layouts.appPublic');
    }
}
