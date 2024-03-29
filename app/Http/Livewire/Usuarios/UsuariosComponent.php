<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use App\Traits\DataModelsInstances;
use App\Traits\DataModelsUser;
use App\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class UsuariosComponent extends Component
{
    use DataModels, DataModelsUser, DataModelsInstances, Helper, WithPagination;

    public $name,
        $email,
        $rol,
        $password,
        $search = null,
        $filterRol=null ,
        $sort='id',
        $listRoles,

       // $listInstances,
        $userSelected = null,
        //$userSelectedInstance = null,
        $modalModeDestroy = false,
        $formUpdate = false,
        $sortDirection = 'desc';

    protected $paginationTheme = 'bootstrap';

    protected function rules(){
        return[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'rol'=>['required','in:'.$this->getUsersRoles()->implode(',')],
            'instanceSelected'=>'required'
        ];
    }
    protected function messages(){
        return [
            'instanceSelected.required'=>'Debe seleccionar una instancia!'
        ];
    }


    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->listRoles = $this->getUsersRoles();
        $this->password = $this->generateChar(10);
    }

    public function addUser(){
        $this->reset(['name','email', 'rol','formUpdate','userSelected', 'modalModeDestroy']);
        $this->setConfigModal();
        $this->resetErrorBag();
        $this->generateNewPass();
    }

    public function resetProps(){
        $this->reset(['name','email', 'rol','formUpdate', 'userSelected', 'modalModeDestroy', 'instancias']);
        $this->setConfigModal();
        $this->resetErrorBag();
        $this->generateNewPass();
        $this->emit('saveModal');
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedRol($role){
        if ($role == 'Comerciante'){
            dd($role);
        }
    }

    public function updatedFilterRol(){
        $this->resetPage();
    }

    public function generateNewPass(){
        $this->password = $this->generateChar(10);
    }

   /* public function getUserInstance($userId){
        $this->emit('getUserSelected', $userId);
        $this->userSelectedInstance = $userId;
    }*/

    public function store(){
       $this->validate();
        $user = User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'rol'=>$this->rol,
            'instance_id'=>$this->instanceSelected
        ]);
        $this->resetProps();
    }

    public function edit(User $user){
        $this->resetErrorBag();
        $this->userSelected = $user->id;
        $this->modalModeDestroy = false;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = null;
        $this->rol = $user->rol;
        $this->instanceSelected = $user->instance_id;
        $this->formUpdate=true;
        $this->setConfigModal('Editar usuario', 'fa-edit','edit');

    }

    public function updateUser(User $user){
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => ' nullable|string|min:8',
            'rol'=>['required','in:'.$this->getUsersRoles()->implode(',')],
            'instanceSelected'=>'required'
        ]);
        if(is_null($this->password)){
            $data = ['name'=>$this->name, 'email'=>$this->email, 'rol'=>$this->rol, 'instance_id'=>$this->instanceSelected];
        }else{
            $data = ['name'=>$this->name, 'email'=>$this->email, 'password'=>Hash::make($this->password) ,'rol'=>$this->rol, 'instance_id'=>$this->instanceSelected];
        }
        $user->fill($data)->save();
        $this->resetProps();
    }

    public function trashUser(User $user){
        $this->modalModeDestroy = true;
        $this->name = $user->name;
        $this->userSelected = $user->id;
        $this->setConfigModal('Eliminar usuario', 'fa-trash','trash');
    }

    public function destroy(User $user){
        $user->delete();
        $this->resetProps();
    }


    /** Render del componente
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $usuarios = $this->getAllUsers($this->search, $this->instancias, $this->sort, $this->sortDirection, $this->filterRol);
        return view('livewire.administrator.usuarios-component', compact('usuarios'))
            ->extends('layouts.app');
    }
}
