<?php

namespace App\Http\Livewire\Avisos;

use App\Traits\DataModels;
use App\Traits\Helper;
use Livewire\Component;
use Livewire\WithPagination;

class AvisosComponent extends Component
{
    use DataModels, Helper, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $colors, $stateSelected=null;

    protected $listeners = [
        'refreshState'=>'render'
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->colors = $this->getClassColor();
    }

    public function updatedStateSelected(){
        $this->resetPage();
    }


    public function render()
    {
        $listStates = $this->getAllState();
        $avisos = $this->getAllWarnings($this->stateSelected, $this->sort, $this->sortDirection);
        return view('livewire.administrator.avisos.avisos-component', compact('avisos', 'listStates'));
    }
}
