<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Instance;
use App\Traits\DataModels;
use App\Traits\Helper;
use Livewire\Component;

class UsuariosInstanciasComponent extends Component
{
    use DataModels, Helper;

    public
        $listRoles,
        $limitUsers=10,
        $name,
        $rol,
        $userInstanceSelected = [],
        $userInstance,
        $instanceSelected,
        $search;

    protected $listeners = ['getInstanceSelected'];

    public function mount(){
        $this->listRoles = $this->getUsersRoles();
        $this->userInstance = collect();
    }

    public function getInstanceSelected(Instance $instance){
        $this->instanceSelected = $instance->id;
        $this->name = $instance->name;

        $this->reset('userInstanceSelected', 'limitUsers', 'rol', 'search');
        $this->userInstance = $this->getUserWithInstance($instance->id);
        foreach ($this->userInstance as $value){
            $this->userInstanceSelected[$value->id] = $value->id;
        }

    }

    public function saveUsers(Instance $instance){
        $users = [];
        foreach ($this->userInstanceSelected as $user){
            if($user){
                $users[] = $user;
            }
        }
        $instance->users()->sync($users);
        $this->reset('userInstanceSelected');
        $this->emit('saveModal');
        $this->emit('newInstanceAdd');
    }

    public function render()
    {
        $usuarios = $this->getAllUsersWhithFilter($this->search,$this->limitUsers, $this->rol);
        return view('livewire.administrator.usuarios.usuarios-instancias-component', compact('usuarios'));
    }
}
