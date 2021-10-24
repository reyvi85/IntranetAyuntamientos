<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use App\Traits\Helper;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class UsuariosComponent extends Component
{
    use DataModels;
    use Helper;
    use WithPagination;

    public $name,
        $email,
        $rol,
        $password,
        $search = null,
        $filterRol=null ,
        $sort='id',
        $listRoles,
        $userSelected = null,
        $userSelectedInstance = null,
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
        ];
    }


    public function mount(){
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
        $this->reset(['name','email', 'rol','formUpdate', 'userSelected', 'modalModeDestroy']);
        $this->setConfigModal();
        $this->resetErrorBag();
        $this->generateNewPass();
        $this->emit('saveModal');
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedFilterRol(){
        $this->resetPage();
    }

    public function generateNewPass(){
        $this->password = $this->generateChar(10);
    }

    public function getUserInstance($userId){
        $this->emit('getUserSelected', $userId);
        $this->userSelectedInstance = $userId;
    }

    public function store(){
       $this->validate();
        $user = User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'rol'=>$this->rol
        ]);
        if(auth()->user()->rol !='Super-Administrador'){
            //$instance = auth()->user()->instances->last()->id;
           $user->instances()->sync(auth()->user()->instances->last());
        }
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
        $this->formUpdate=true;
        $this->setConfigModal('Editar usuario', 'fa-edit','edit');

    }

    public function updateUser(User $user){
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => ' nullable|string|min:8',
            'rol'=>['required','in:'.$this->getUsersRoles()->implode(',')],
        ]);
        if(is_null($this->password)){
            $data = ['name'=>$this->name, 'email'=>$this->email, 'rol'=>$this->rol];
        }else{
            $data = ['name'=>$this->name, 'email'=>$this->email, 'password'=>Hash::make($this->password) ,'rol'=>$this->rol];
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
        //dd(auth()->user()->instances()->sync([3]));
        $usuarios = $this->getAllUsers($this->search, $this->sort, $this->sortDirection, $this->filterRol);
        return view('livewire.administrator.usuarios-component', compact('usuarios'))
            ->extends('layouts.app');
    }
}
