<?php

namespace App\Http\Livewire;

use App\Models\InterestPhone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class InterestPhonesComponent extends Component
{
    use DataModels, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search, $name, $description, $phone, $instance_id, $phoneSelected;

    protected function rules(){
            return [
                'name'=>'required',
                'description'=>'nullable',
                'phone'=>'required',
                'instanceSelected'=>'required'
            ];
    }

    protected $messages =[
        'instance_id.required'=>'Debe seleccionar una instancia'
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal('Añadir teléfono');
    }

    public function resetProps(){
        $this->reset(['name', 'description', 'phone', 'instanceSelected', 'modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        InterestPhone::create([
            'name'=>$this->name,
            'description'=>$this->description,
            'phone'=>$this->phone,
            'instance_id'=>$this->instanceSelected
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(InterestPhone $interestPhone){
        $this->setConfigModal('Editar teléfono', 'fa-edit', 'edit');
        $this->resetErrorBag();
        $this->modalModeDestroy = false;
        $this->phoneSelected = $interestPhone->id;
        $this->name = $interestPhone->name;
        $this->description = $interestPhone->description;
        $this->phone = $interestPhone->phone;
        $this->instanceSelected = $interestPhone->instance_id;
    }

    public function update_phone(InterestPhone $interestPhone){
        $this->validate();
        $interestPhone->fill([
            'name'=>$this->name,
            'description'=>$this->description,
            'phone'=>$this->phone,
            'instance_id'=>$this->instanceSelected
        ])->save();

        $this->emit('saveModal');
    }

    public function trash(InterestPhone $interestPhone){
        $this->modalModeDestroy =true;
        $this->phoneSelected = $interestPhone->id;
        $this->setConfigModal('Eliminar teléfono', 'fa-trash', 'trash');
        $this->name = $interestPhone->name;
    }

    public function destroy(InterestPhone $interestPhone){
        $interestPhone->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }


    public function render()
    {
        $telefonos = $this->getAllPhone($this->search, $this->instancias, $this->sort, $this->sortDirection);
        return view('livewire.administrator.interest-phones-component', compact('telefonos'))
            ->extends('layouts.app');
    }
}
