<?php

namespace App\Http\Livewire\Routes;

use App\Models\RouteCategory;
use App\Traits\DataModels;
use Livewire\Component;

class RoutesCategoryComponent extends Component
{
    use DataModels;

    public $name, $categorySelected, $search;

    protected $rules = [
        'name'=>'required|unique:route_categories,name',
    ];

    public function mount(){
        $this->setConfigModal();
    }

    public function resetProps(){
        $this->reset(['name', 'categorySelected', 'modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        RouteCategory::create([
            'name'=>$this->name
        ]);
        $this->emit('saveModal');
        $this->emit('categoryUDPT');
        $this->resetProps();
    }

    public function edit(RouteCategory $routeCategory)
    {
        $this->resetProps();
        $this->setConfigModal('Editar categoría', 'fa-edit', 'edit');
        $this->categorySelected = $routeCategory->id;
        $this->name = $routeCategory->name;
    }

    public function update_category(RouteCategory $routeCategory){
        $this->validate([
            'name'=>'required|unique:route_categories,name,'.$routeCategory->id,
        ]);
        $routeCategory->fill([
            'name'=>$this->name
        ])->save();
        $this->emit('saveModal');
        $this->emit('categoryUDPT');
        $this->resetProps();
    }

    public function trash(RouteCategory $routeCategory){
        //$this->resetProps();
        $this->setConfigModal('Eliminar categoría', 'fa-trash', 'trash');
        $this->name = $routeCategory->name;
        $this->categorySelected = $routeCategory->id;
        $this->modalModeDestroy = true;
    }

    public function destroy(RouteCategory $routeCategory){
        $routeCategory->delete();
        $this->emit('saveModal');
        $this->emit('categoryUDPT');
        $this->resetProps();
    }

    public function render()
    {
        $listCategory = $this->getCategoryRoutes($this->search,$this->sort, $this->sortDirection);
        return view('livewire.administrator.routes.routes-category-component', compact('listCategory'));
    }
}
