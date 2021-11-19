<?php

namespace App\Http\Livewire\Avisos;

use App\Models\Warning;
use App\Traits\DataModels;
use App\Traits\Helper;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AvisosComponent extends Component
{
    use DataModels, Helper, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public
        $asunto,
        $description,
        $image,
        $imageWarning=null,
        $lat,
        $lng,
        $instance_id,

        $warning_state,
        $warning_category,
        $warningCategorySelected,
        $warning_sub_category,
        $warningSubCategorySelected,
        $user_id,

        $colors, $warnigSelected,$stateSelected=null;

    protected $listeners = [
        'refreshState'=>'render'
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->colors = $this->getClassColor();
    }

    public function updatedStateSelected(){
        $this->resetPage();
    }
    public function updatedInstanceSelected(){
        $this->warning_category = $this->getWarningsCategoryFiltered($this->instanceSelected);
    }

    public function updatedWarningCategorySelected(){
        $this->warning_sub_category = $this->getWarningSubCategoryFiltered($this->warningCategorySelected);
    }

    public function resetProps(){

    }

    public function add(){

        $this->emit('initMap', config('maps.lat_default'), config('maps.lng_default'));
    }

    public function edit(Warning $warning){
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->instanceSelected = $warning->instance_id;
        $this->asunto = $warning->asunto;
        $this->description = $warning->description;
        $this->imageWarning = $warning->image;
        $this->warningCategorySelected = $warning->warning_sub_category->warning_category->id;
        $this->warningSubCategorySelected = $warning->warning_sub_category_id;
        $this->warning_state = $warning->warning_state_id;

        $this->emit('initMap', config('maps.lat_default'), config('maps.lng_default'));
    }

    public function update(Warning $warning){

    }


    public function render()
    {
        $listStates = $this->getAllState();
        $avisos = $this->getAllWarnings($this->stateSelected, $this->sort, $this->sortDirection);
        return view('livewire.administrator.avisos.avisos-component', compact('avisos', 'listStates'));
    }
}
