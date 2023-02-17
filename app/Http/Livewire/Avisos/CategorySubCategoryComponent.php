<?php

namespace App\Http\Livewire\Avisos;

use App\Models\WarningCategory;
use App\Models\WarningSubCategory;
use App\Traits\DataModels;
use App\Traits\DataModelsAvisos;
use App\Traits\DataModelsInstances;
use Livewire\Component;
use Livewire\WithPagination;

class CategorySubCategoryComponent extends Component
{
    use DataModels, DataModelsAvisos, DataModelsInstances, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name,
        $search,

        $idCategory,

        $categorySelected,
        $workSubCategory=false,
        $subCategorySelected;

    protected $rules = [
        'name'=>'required',
        'instanceSelected'=>'required',
    ];

    protected $messages = [
        'name.required'=>'El nombre es requerido!',
        'instanceSelected.required'=>'Debe seleccionar una instancia!',
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal('Añadir categoría');
        $this->idCategory = 0;
    }

    public function resetProps(){
        $this->reset(['name', 'categorySelected', 'subCategorySelected', 'workSubCategory','modalModeDestroy']);
        $this->resetErrorBag();
    }
    /**
     * Categorías
     **/
    public function addCategory(){
        $this->resetProps();
        $this->setConfigModal('Añadir categoría');
    }

    public function storeCategory(){
        $this->validate();
        WarningCategory::create([
                'name'=>$this->name,
                'instance_id'=>$this->instanceSelected
            ]
        );
        $this->emit('saveModal');
    }

    public function editCategory(WarningCategory $warningCategory){
        $this->resetProps();
        $this->setConfigModal('Editar categoría', 'fa-edit', 'edit-category');
        $this->categorySelected = $warningCategory->id;
        $this->name = $warningCategory->name;
        $this->instanceSelected = $warningCategory->instance_id;
    }

    public function update_category(WarningCategory $warningCategory){
        $this->validate();
        $warningCategory->fill([
            'name'=>$this->name,
            'instance_id'=>$this->instanceSelected
        ])->save();
        $this->resetProps();
        $this->emit('saveModal');
    }

    public function trashCategory(WarningCategory $warningCategory){
        $this->setConfigModal('Eliminar categoría', 'fa-trash', 'trash-category');
        $this->name = $warningCategory->name;
        $this->modalModeDestroy = true;
        $this->categorySelected = $warningCategory->id;
    }

    public function destroyCategory(WarningCategory $warningCategory){
       $warningCategory->delete();
       $this->resetProps();
        $this->emit('saveModal');
    }

    /**
     * Sub-Categorías
    */

    public function addSubCategory(WarningCategory $warningCategory){
        $this->resetProps();
        $this->categorySelected = $warningCategory->id;
        $this->instanceSelected = $warningCategory->instance_id;
        $this->workSubCategory = true;
        $this->setConfigModal('Añadir sub - categoría', 'fa-plus-circle', 'store-sub-category');
    }

    public function storeSubCategory(){
        $this->validate();
        WarningSubCategory::create([
            'name'=>$this->name,
            'warning_category_id'=>$this->categorySelected
        ]);
        $this->idCategory = $this->categorySelected;
        $this->emit('saveModal');
    }

    public function editSubCategory(WarningSubCategory $warningSubCategory){
        $this->resetProps();
        $this->setConfigModal('Editar sub-categoría', 'fa-edit', 'edit-sub-category');
        $this->workSubCategory = true;
        $this->instanceSelected = $warningSubCategory->warning_category->instance_id;
        $this->subCategorySelected = $warningSubCategory->id;
        $this->categorySelected = $warningSubCategory->warning_category_id;
        $this->name = $warningSubCategory->name;
    }

    public function update_Subcategory(WarningSubCategory $warningSubCategory){
        $this->validate();
        $this->workSubCategory = true;
        $warningSubCategory->fill([
            'name'=>$this->name,
            'warning_category_id'=>$this->categorySelected
        ])->save();
        $this->idCategory = $this->categorySelected;
        $this->emit('saveModal');
    }

    public function trashSubCategory(WarningSubCategory $warningSubCategory){
        $this->setConfigModal('Eliminar sub - categoría', 'fa-trash', 'trash-sub-category');
        $this->name = $warningSubCategory->name;
        $this->subCategorySelected = $warningSubCategory->id;
        $this->modalModeDestroy = true;
    }

    public function destroySubCategory(WarningSubCategory $warningSubCategory){
        $warningSubCategory->delete();
        $this->resetProps();
        $this->emit('saveModal');
    }

    public function render()
    {
        $categorias = $this->getAllWarningsCategory($this->search, $this->instancias, $this->sort, $this->sortDirection);
        return view('livewire.administrator.avisos.category-sub-category-component', compact('categorias'));
    }
}
