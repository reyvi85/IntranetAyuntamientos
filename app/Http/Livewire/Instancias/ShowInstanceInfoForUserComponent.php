<?php

namespace App\Http\Livewire\Instancias;

use Livewire\Component;

class ShowInstanceInfoForUserComponent extends Component
{
    public $instanceSelected, $name;

    protected $listeners = 'loadInstance';

    public function mount(){
        if (session()->has('instance_selected')){
            $this->instanceSelected = session('instance_selected');
            $this->name = $this->instanceSelected['name'];
        }else{
            $this->name=null;
        }
    }

    public function loadInstance(){
        $this->instanceSelected = session('instance_selected');
        $this->name = $this->instanceSelected['name'];
    }

    public function render()
    {
        return view('livewire.administrator.instancias.show-instance-info-for-user-component');
    }
}
