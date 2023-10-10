<?php

namespace App\Http\Livewire\Ampa;

use App\Models\Ampa;
use App\Traits\DataModelAmpa;
use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithPagination;

class Ampacomponent extends Component
{
    use DataModels, DataModelAmpa, WithPagination;
    public $search, $nombre, $dni, $clientSelected;

    protected $rules = [
        'nombre'=>'required|unique:ampa',
        'dni'=>'required|unique:ampa',

    ];

    public function mount(){
        $this->setConfigModal();
    }

    public function changeToogle(Ampa $ampa){
        $toggle = ($ampa->Active ==true)?0:1;
        $ampa->fill(['Active'=>$toggle])->save();
    }

    public function resetProps(){
    $this->resetErrorBag();
    $this->reset(['nombre','dni','clientSelected','modalModeDestroy']);
}
    public function updatedSearch(){
       $this->resetPage();
       $this->setConfigModal('Añadir widget');
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        Ampa::create([
            'Nombre'=>$this->nombre,
            'Dni'=>$this->dni
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(Ampa $ampa){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->clientSelected = $ampa->Id;
        $this->nombre = $ampa->Nombre;
        $this->dni = $ampa->Dni;
    }

    public function update_ampa(Ampa $ampa){
        $this->validate([
            'nombre'=>'required|unique:ampa,Nombre,'.$ampa->Id,
            'dni'=>'required|unique:ampa,Dni,'.$ampa->Id,
        ]);
        $ampa->fill([
            'Nombre'=>$this->nombre,
            'Dni'=>$this->dni
        ])->save();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function trash(Ampa $ampa){
        $this->modalModeDestroy = true;
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->nombre = $ampa->Nombre;
        $this->dni = $ampa->Dni;
        $this->clientSelected = $ampa->Id;
    }

    public function destroy(Ampa $ampa){
        $ampa->delete();
        $this->emit('saveModal');
    }


    public function render()
    {
        return view('livewire.administrator.ampa.ampa-component',
            ['listClient'=>$this->getAllClientAmpa($this->search)])
            ->extends('layouts.app');;
    }
}
