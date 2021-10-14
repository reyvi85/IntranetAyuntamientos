<?php

namespace App\Http\Livewire\Instancias;

use App\Models\Instance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\DataModels;

class ListInstanceForUserComponent extends Component
{
    use DataModels;

    protected $listeners = 'newInstanceAdd';

    public $list_intance,$instanceSelected;

    public function mount(){
        $instances =  $this->getAllInstace();
        $this->list_intance = $instances;
        $this->instanceSelected = $instances->last();
        session(['instance_selected'=>$this->instanceSelected]);
    }

    public function changeInstance(Instance $instance){

        $this->instanceSelected = $instance;
        session(['instance_selected'=>$instance]);
        $this->emit('loadInstance');
    }

    public function newInstanceAdd(){
        $this->list_intance = $this->getAllInstace();
    }

    public function updatedInstanceSelected(){
       // $this->list_intance = $this->getAllInstace();
    }


    public function render()
    {
        return view('livewire.administrator.instancias.list-instance-for-user-component');
    }
}
