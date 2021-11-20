<?php

namespace App\Http\Livewire\Avisos;

use App\Models\Warning;
use App\Traits\DataModels;
use App\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $user,

        $colors, $warnigSelected,$stateSelected=null;

    protected $listeners = [
        'refreshState'=>'render', 'getLatitudeForInput',  'getLongitudeForInput'
    ];

    protected $rules = [
        'asunto'=>'required',
        'warning_state'=>'required',
        'description'=>'required',
        'image'=>'nullable|image|max:3072',
        'instanceSelected'=>'required',
        'warningCategorySelected'=>'required',
        'warningSubCategorySelected'=>'required',
        'instanceSelected'=>'required'
    ];

    protected $messages =[
        'description.required'=>'La descripción es requerida!',
        'warning_state.required'=>'Debe seleccionar un estado!',
        'instanceSelected.required'=>'La instancia es requerida!',
        'warningCategorySelected.required'=>'Debe seleccionar una Categoría!',
        'warningSubCategorySelected.required'=>'Debe seleccionar una Sub - categoría!',
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->colors = $this->getClassColor();
        $this->warning_category = $this->getWarningsCategoryFiltered($this->instanceSelected);
        $this->setPatchToUpload('images/avisos');
    }

    public function getLatitudeForInput($value)
    {
        if(!is_null($value))
            $this->lat = $value;
    }
    public function getLongitudeForInput($value)
    {
        if(!is_null($value))
            $this->lng = $value;
    }

    public function updatedStateSelected(){
        $this->resetPage();
    }
    public function updatedInstanceSelected(){
        if($this->instanceSelected == ""){
            $this->reset(['warningCategorySelected','warning_category','warning_sub_category']);
        }else{
            $this->warning_category = $this->getWarningsCategoryFiltered($this->instanceSelected);
            $this->reset('warning_sub_category');
        }
    }

    public function updatedWarningCategorySelected(){
        if($this->warningCategorySelected ==""){
            $this->warning_sub_category = null;
        }else{
            $this->warning_sub_category = $this->getWarningSubCategoryFiltered($this->warningCategorySelected);
           // $this->warningSubCategorySelected = $this->warning_sub_category->first();
        }
    }

    public function resetProps(){
        $this->reset(['asunto', 'description', 'image', 'imageWarning', 'lat', 'lng', 'instance_id',
            'warning_state','warningCategorySelected','warningSubCategorySelected', 'warning_sub_category', 'warning_category','user', 'modalModeDestroy'
            ]);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->lat = config('maps.lat_default');
        $this->lng = config('maps.lng_default');
        $this->emit('initMap', $this->lat, $this->lng);
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        if($this->image){
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $img = '';
        }
        Warning::create([
            'asunto'=>$this->asunto,
            'description'=>$this->description,
            'image'=>$img,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'instance_id'=>$this->instanceSelected,
            'warning_state_id'=>$this->warning_state,
            'warning_sub_category_id'=>$this->warningSubCategorySelected,
            'user_id'=>Auth::id()
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(Warning $warning){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->warnigSelected = $warning->id;
        $this->instanceSelected = $warning->instance_id;
        /** Categoría */
        $this->updatedInstanceSelected();
        $this->warningCategorySelected = $warning->warning_sub_category->warning_category->id;

        /** Sub-categoría **/
        $this->updatedWarningCategorySelected();
        $this->warningSubCategorySelected = $warning->warning_sub_category_id;

        $this->asunto = $warning->asunto;
        $this->description = $warning->description;
        $this->imageWarning = $warning->image;
        $this->warning_state = $warning->warning_state_id;
        $this->user = $warning->user_id;
        $this->lat = $warning->lat;
        $this->lng = $warning->lng;
        $this->emit('initMap', $this->lat, $this->lng);
    }

    public function update_warning(Warning $warning){
        $this->validate([
            'image'=>'nullable|image',
        ]);
        if($this->image){
            Storage::disk('public')->delete($warning->image);
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $img = $warning->image;
        }

        $warning->fill([
            'asunto'=>$this->asunto,
            'description'=>$this->description,
            'image'=>$img,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'instance_id'=>$this->instanceSelected,
            'warning_state_id'=>$this->warning_state,
            'warning_sub_category_id'=>$this->warningSubCategorySelected,
            'user_id'=>$this->user
        ])->save();
        $this->emit('saveModal');
    }

    public function destroy_image(Warning $warning){
        Storage::disk('public')->delete($warning->image);
        $warning->fill(['image'=>null])->save();
        $this->imageWarning = null;
    }

    public function trashWarning(Warning $warning){
        $this->resetProps();
        $this->setConfigModal('Eliminar aviso', 'fa-trash', 'trash');
        $this->warnigSelected = $warning->id;
        $this->modalModeDestroy = true;
        $this->asunto = $warning->asunto;
    }

    public function destroy(Warning $warning){
        Storage::disk('public')->delete($warning->image);
        $warning->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }


    public function render()
    {
        $listStates = $this->getAllState();
        $avisos = $this->getAllWarnings($this->stateSelected, $this->sort, $this->sortDirection);
        return view('livewire.administrator.avisos.avisos-component', compact('avisos', 'listStates'));
    }
}
