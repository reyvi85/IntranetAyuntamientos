<?php

namespace App\Http\Livewire\Business;

use App\Models\CategoryBusine;
use App\Traits\DataModelsBusiness;
use Livewire\Component;
use App\Traits\DataFront,
    Livewire\WithPagination;

class ShowPublicBusiness extends Component
{
    use DataModelsBusiness, WithPagination;

    public $search=null, $listCategoryBussiness, $categorySelected=null, $viewList = false;
    public $keyInst;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->keyInst = request('token_inst');
       // $this->listCategoryBussiness = $this->getAllCategoryBusiness()->where('business_count','<>',0);

    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedCategorySelected(){
        $this->resetPage();
    }

    public function updatedViewList(){
        $this->resetPage();
    }

    public function changeView(){
        if($this->viewList){
            $this->viewList = false;
        }else{
            $this->viewList = true;
        }
    }

    public function render()
    {
        $keyInst = request('token_inst');
        return view('livewire.front.show-public-business', [
            'listBusiness' =>$this->getBusinessPublic($this->keyInst, $this->search, $this->categorySelected),
        ])
            ->extends('layouts.appPublic');
    }

    public function getCategoriesProperty(){
        return CategoryBusine::withCount(['business'=>function($q){
            $q->GetInstance('instance', $this->keyInst);
        }])
            ->get()->where('business_count','!=',0);
    }
}
