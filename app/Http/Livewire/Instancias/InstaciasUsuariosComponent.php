<?php

namespace App\Http\Livewire\Instancias;

use App\Models\User;
use App\Traits\DataModels;
use Livewire\Component;

class InstaciasUsuariosComponent extends Component
{
    use DataModels;

    public $instaceSlecteds = [], $search=null, $userName, $userSelected, $limitInstance = 5;

    protected $listeners = ['getUserSelected'];


    public function mount(){
       $this->instaceSlecteds = collect();
    }

    public function getUserSelected(User $user){
        $this->userName = $user->name;
        $this->userSelected  = $user->id;
        $this->reset(['instaceSlecteds', 'search', 'limitInstance']);
        foreach ($this->getInstanceWithUser($user->id) as $key=>$value){
            $this->instaceSlecteds[$value->id] = $value->id;
        }
    }

    public function render()
    {
        $instancias=$this->getAllInstancias($this->search, $this->limitInstance);
        return view('livewire.administrator.instancias.instacias-usuarios-component', compact('instancias'));
    }

    public function saveInstace(User $user){
       $instances = [];
       foreach ($this->instaceSlecteds as $instance){
           if($instance){
               $instances[] = $instance;
           }
       }
        $user->instances()->sync($instances);
        $this->reset('instaceSlecteds');
        $this->emit('saveModal');
        $this->emit('newInstanceAdd');

    }
}
