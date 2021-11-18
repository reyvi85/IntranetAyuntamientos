<?php

namespace App\Http\Livewire\Avisos;

use App\Models\WarningState;
use App\Traits\DataModels;
use App\Traits\Helper;
use Livewire\Component;

class StatesComponent extends Component
{
    use DataModels, Helper;
    public $name, $stateSelected, $listColors, $colorSelected='primary';


    public function mount(){
        $this->listColors = $this->getClassColor();
        $this->setConfigModal('Añadir estado');
    }


    public function resetProps(){
        $this->reset(['name', 'modalModeDestroy', 'stateSelected', 'colorSelected']);
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal('Añadir estado');
    }

    public function store(){
        $this->validate([
            'name'=>'required|unique:warning_states'
        ]);
        WarningState::create([
            'name'=>$this->name,
            'color'=>$this->colorSelected
        ]);
        $this->resetProps();
        $this->emit('saveModal');
        $this->emit('refreshState');
    }

    public function edit(WarningState $warningState){
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->stateSelected = $warningState->id;
        $this->colorSelected = $warningState->color;
        $this->name = $warningState->name;
    }

    public function update_state(WarningState $warningState){
        $attr = $this->validate([
            'name'=>'required|unique:warning_states,name,'.$warningState->id
        ]);
        $warningState->fill([
            'name'=>$this->name,
            'color'=>$this->colorSelected
        ])->save();
        $this->resetProps();
        $this->emit('saveModal');
        $this->emit('refreshState');
    }
    public function trash(WarningState $warningState){
        $this->modalModeDestroy =true;
        $this->setConfigModal('Eliminar estado', 'fa-trash', 'trash');
        $this->name = $warningState->name;
        $this->stateSelected = $warningState->id;
    }

    public function destroy(WarningState $warningState){
        $warningState->delete();
        $this->resetProps();
        $this->emit('saveModal');
        $this->emit('refreshState');
    }

    public function render()
    {
        $listStates = $this->getAllState();
        return view('livewire.administrator.avisos.states-component', compact('listStates'));
    }
}
