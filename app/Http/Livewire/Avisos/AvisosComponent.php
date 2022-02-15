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
        $ubicacion,
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

        $colors, $warnigSelected,$stateSelected=null,
        $respuesta,
        $listAnswers,

        /* Filtros **/
    $search,
    $listCategoryFilter,
        $categoryFilterSelected,
    $listSubCategoryFilter,
        $subCategoryFilterSelected,
    $fechaFilter,

        $modalModeShow=false
    ;


    protected $listeners = [
        'refreshState'=>'render', 'getLatitudeForInput',  'getLongitudeForInput', 'getFechaFilter'
    ];

    protected $rules = [
        'asunto'=>'required',
        'warning_state'=>'required',
        'description'=>'required',
        'ubicacion'=>'required',
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
        $this->listAnswers = collect();
      //  dd('pp');
        $this->listSubCategoryFilter = [];
        $this->setPatchToUpload('images/avisos');
    }

    /** LISTENNER **/
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

    public function getFechaFilter($value){
        if(!is_null($value))
            $this->fechaFilter = $value;
    }

    /** END LISTENNER**/

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

    public function updatedInstancias()
    {
        $this->listSubCategoryFilter = collect();
    }

    public function updatedCategoryFilterSelected(){
        if ($this->categoryFilterSelected == ""){
            $this->listSubCategoryFilter = collect();
        }else{
            $this->listSubCategoryFilter = $this->getWarningSubCategoryFiltered($this->categoryFilterSelected);
        }
    }

    public function updatedSubCategoryFilterSelected()
    {
        $this->listSubCategoryFilter = $this->getWarningSubCategoryFiltered($this->categoryFilterSelected);
    }

    public function updatedWarningCategorySelected(){
        if($this->warningCategorySelected ==""){
            $this->warning_sub_category = null;
        }else{
            $this->warning_sub_category = $this->getWarningSubCategoryFiltered($this->warningCategorySelected);
        }
    }

    public function resetProps(){
        $this->reset(['asunto', 'description', 'ubicacion','image', 'imageWarning', 'lat', 'lng', 'instance_id',
            'warning_state', 'warnigSelected','warningCategorySelected','warningSubCategorySelected', 'warning_sub_category', 'warning_category','user', 'modalModeShow','modalModeDestroy'
            ]);
        $this->resetErrorBag();
    }

    public function show($warning, $lat, $lng){
        $this->setConfigModal('Ver aviso', 'fa-eye', 'show');
        $this->modalModeShow =true;
        $this->warnigSelected = $warning;
        $this->emit('showMap', $lat, $lng);
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
            'ubicacion'=>$this->ubicacion,
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
        $this->listAnswers = $warning->warning_answers()->orderBy('created_at', 'Desc')->get();
        /** Categoría */
        $this->updatedInstanceSelected();
        $this->warningCategorySelected = $warning->warning_sub_category->warning_category->id;

        /** Sub-categoría **/
        $this->updatedWarningCategorySelected();
        $this->warningSubCategorySelected = $warning->warning_sub_category_id;

        $this->asunto = $warning->asunto;
        $this->description = $warning->description;
        $this->ubicacion = $warning->ubicacion;
        $this->imageWarning = $warning->image;
        $this->warning_state = $warning->warning_state_id;
        $this->user = $warning->user_id;
        $this->lat = $warning->lat;
        $this->lng = $warning->lng;
        $this->emit('initMap', $this->lat, $this->lng);
    }

    public function update_warning(Warning $warning){
        $this->validate();
        if($this->image){
            Storage::disk('public')->delete($warning->image);
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $img = $warning->image;
        }

        $warning->fill([
            'asunto'=>$this->asunto,
            'description'=>$this->description,
            'ubicacion'=>$this->ubicacion,
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

    public function storeAnswer(Warning $warning){
        $this->validate(['respuesta'=>'required']);
        $warning->warning_answers()->create([
            'answer'=>$this->respuesta
        ]);
        $this->reset('respuesta');
        $this->listAnswers = $warning->warning_answers()->orderBy('created_at', 'Desc')->get();
    }


    public function render()
    {
        $this->warning_category = $this->getWarningsCategoryFiltered($this->instanceSelected);
        $this->listCategoryFilter = $this->getWarningsCategoryFiltered($this->instancias);
        $listStates = $this->getAllState($this->instancias);
        //dd($listStates);
        $avisos = $this->getAllWarnings($this->search,$this->instancias,$this->fechaFilter,$this->categoryFilterSelected, $this->subCategoryFilterSelected,$this->stateSelected, $this->sort, $this->sortDirection);
        return view('livewire.administrator.avisos.avisos-component', compact('avisos', 'listStates'));
    }
}
