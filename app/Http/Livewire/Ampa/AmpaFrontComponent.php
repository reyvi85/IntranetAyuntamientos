<?php

namespace App\Http\Livewire\Ampa;

use App\Traits\DataModelAmpa;
use App\Traits\DataModelsBusiness;
use Livewire\Component;

class AmpaFrontComponent extends Component
{
    use DataModelAmpa, DataModelsBusiness;
    public $search,
        $listAmpa=[],
        $keyInst =  'DuoLMtXSpiXMaMZlQOGhZi6FIpX2i5toAfjoXMYBbTKSrzrgmDkslzbwNMbVAvO3', //'BQYgL0PQQClcQfZXewcFPTW5gf6NNLARd5y1CGdgpdlTfGk0OMwqEgMyuRBJ9pz0',
        $is_empty = false;


    public function updatedSearch(){
        if ($this->search == ""){
            $this->is_empty = true;
        }else{
            $this->is_empty = true;
        }
    }

    public function found(){
        $this->listAmpa = $this->getClientAmpa($this->search);
    }

    public function render()
    {
        return view('livewire.front.ampa-front-component', [
            'listBusiness' =>$this->getBusinessPublic($this->keyInst, null, null),
            ])
            ->extends('layouts.appPublic');
    }
}
