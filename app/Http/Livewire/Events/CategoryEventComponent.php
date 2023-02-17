<?php

namespace App\Http\Livewire\Events;

use App\Models\EventCategory;
use App\Traits\DataModels;
use App\Traits\DataModelsEvents;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoryEventComponent extends Component
{
    use DataModels, DataModelsEvents, WithFileUploads;

    public $name, $image, $imageSelected, $categorySelected, $search;

    protected $rules =[
        'name'=>'required|unique:event_categories,name',
        'image'=>'required|image'
    ];

    public function mount(){
        $this->setConfigModal();
        $this->setPatchToUpload('images/events/categories');
    }

    public function resetProps(){
        $this->reset(['name', 'image', 'imageSelected','categorySelected', 'modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        $gImage = $this->image->store($this->getPatchToUpload(), 'public');
        EventCategory::create([
           'name'=>$this->name,
            'image'=>$gImage
        ]);
        $this->emit('saveModal');
        $this->emit('addCategoryEvents');
        $this->resetProps();
    }

    public function edit(EventCategory $eventCategory){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->categorySelected = $eventCategory->id;
        $this->imageSelected = $eventCategory->image;
        $this->name = $eventCategory->name;
    }

    public function update_category(EventCategory $eventCategory){
        $this->validate([
            'name'=>'required|unique:event_categories,name,'.$eventCategory->id,
            'image'=>'nullable|image'
        ]);
        if($this->image){
            Storage::disk('public')->delete($eventCategory->image);
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $img = $eventCategory->image;
        }
        $eventCategory->fill([
            'name'=>$this->name,
            'image'=>$img
        ])->save();
        $this->resetProps();
        $this->emit('saveModal');
        $this->emit('addCategoryEvents');
    }

    public function trash(EventCategory $eventCategory){
        $this->categorySelected = $eventCategory->id;
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->name = $eventCategory->name;
    }

    public function destroy(EventCategory $eventCategory){
        Storage::disk('public')->delete($eventCategory->image);
        $eventCategory->delete();
        $this->emit('saveModal');
        $this->emit('addCategoryEvents');
    }

    public function render()
    {
        $listCategory = $this->getAllCategoryEvents($this->search);
        return view('livewire.administrator.events.category-event-component', compact('listCategory'));
    }
}
