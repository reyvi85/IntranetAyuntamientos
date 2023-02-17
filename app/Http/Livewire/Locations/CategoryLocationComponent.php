<?php

namespace App\Http\Livewire\Locations;

use App\Models\LocationCategory;
use App\Traits\DataModels;
use App\Traits\DataModelsLocation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoryLocationComponent extends Component
{
    use DataModels, DataModelsLocation, WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    protected $rules =[
        'name'=>'required',
        'image'=>'required|image|max:1024',
    ];

    public $search, $categorySelected, $name, $image, $imageCategory=null;

    public function mount(){
        $this->setConfigModal();
        $this->setPatchToUpload('images/categorias-localizaciones');
    }

    public function resetProps(){
        $this->reset(['name', 'image', 'imageCategory', 'categorySelected', 'modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        $img = $this->image->store($this->getPatchToUpload(), 'public');
        LocationCategory::create([
            'name'=>$this->name,
            'image'=>$img,
        ]);
        $this->resetProps();
        $this->emit('saveModal');
        $this->emit('addCategoryLocation');

    }

    public function edit(LocationCategory $locationCategory){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->categorySelected = $locationCategory->id;
        $this->imageCategory = $locationCategory->image;
        $this->name = $locationCategory->name;
    }

    public function update_category(LocationCategory $locationCategory){
        $this->validate([
            'name'=>'required',
            'image'=>'nullable|image|max:1024',
        ]);

        if($this->image){
            Storage::disk('public')->delete($locationCategory->image);
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
           $img = $locationCategory->image;
        }
        $locationCategory->fill([
            'name'=>$this->name,
            'image'=>$img,
        ])->save();
        $this->resetProps();
        $this->emit('saveModal');
        $this->emit('addCategoryLocation');
    }

    public function trash(LocationCategory $locationCategory){
        $this->categorySelected = $locationCategory->id;
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->name = $locationCategory->name;
    }

    public function destroy(LocationCategory $locationCategory){
        Storage::disk('public')->delete($locationCategory->image);
        $locationCategory->delete();
        $this->emit('saveModal');
        $this->emit('addCategoryLocation');
        $this->resetProps();
    }

    public function render()
    {
        $listCategory = $this->getCategoryLocation($this->search, $this->sort, $this->sortDirection);
        return view('livewire.administrator.locations.category-location-component', compact('listCategory'));
    }
}
