<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Instance;
use App\Models\User;
use App\Traits\DataModels;
use App\Traits\DataModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class UserPerInstanceComponent extends Component
{
    use DataModels,DataModelsUser, WithPagination;
    public $search, $instanceSelected, $userSelected;

    protected $listeners = ['selectInstance', 'selectUser'];

    public function mount(Instance $instance){
        $this->instanceSelected = $instance;

    }

    public function selectInstance($instance){
        $this->instanceSelected = $instance;
        $this->render();
    }
        public function selectUserMember($instance){
        $this->instanceSelected = $instance;
        $this->render();
    }

    public function selectUser(User $user){
        $this->userSelected = $user->id;
        $this->emit('userSelectedPerInstance', [$user->id]);
    }

    public function render()
    {
        $listUsers = $this->getUsersPerInstances($this->instanceSelected);
        return view('livewire.administrator.usuarios.user-per-instance-component', compact('listUsers'));
    }
}
