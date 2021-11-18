<?php

namespace App\Http\Livewire\Avisos;

use App\Models\WarningState;
use App\Traits\DataModels;
use Livewire\Component;

class StatesComponent extends Component
{
    use DataModels;
    public $name, $stateSelected, $nameSelected, $listStates;

    protected $listeners = ['udptState'];

    public function mount(){
        $this->listStates = $this->getAllState();
        $this->nameSelected = null;
        $this->setConfigModal();
    }

    public function udptState(){
        $this->listStates = $this->getAllState();
        $this->setConfigModal();
    }

    public function resetProps(){
        $this->reset(['name', 'modalModeDestroy', 'stateSelected', 'nameSelected']);
    }
    public function store(){
        $attr = $this->validate([
            'name'=>'required|unique:warning_states'
        ]);
        WarningState::create($attr);
        $this->resetProps();
        $this->emit('udptState');
    }

    public function edit(WarningState $warningState){
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->stateSelected = $warningState->id;
        $this->name = $warningState->name;
    }

    public function update_state(WarningState $warningState){
        $attr = $this->validate([
            'name'=>'required|unique:warning_states,name,'.$warningState->id
        ]);
        $warningState->fill($attr)->save();
        $this->resetProps();
        $this->emit('udptState');
    }
    public function trash(WarningState $warningState){
       // $this->modalModeDestroy =true;
        $this->nameSelected = $warningState->name;
        $this->stateSelected = $warningState->id;
    }

    public function destroy(WarningState $warningState){
        $warningState->delete();
        $this->resetProps();
        $this->emit('udptState');
        $this->emit('saveModal');
    }

    public function render()
    {
        return view('livewire.administrator.avisos.states-component');
    }
}
