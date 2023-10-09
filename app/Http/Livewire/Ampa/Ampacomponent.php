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
    public function updatedSearch(){
       $this->resetPage();
    }

    public function add(){
        $this->resetProps();

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

    public function resetProps(){
        $this->resetErrorBag();
        $this->reset(['nombre','dni','clientSelected','modalModeDestroy']);
    }

    public function render()
    {
        return view('livewire.administrator.ampa.ampa-component',
            ['listClient'=>$this->getAllClientAmpa($this->search)])
            ->extends('layouts.app');;
    }
}
