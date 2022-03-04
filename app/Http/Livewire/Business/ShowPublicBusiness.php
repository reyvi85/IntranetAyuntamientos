<?php

namespace App\Http\Livewire\Business;

use Livewire\Component;
use App\Traits\DataFront,
    Livewire\WithPagination;

class ShowPublicBusiness extends Component
{
    use DataFront, WithPagination;

    public $listCategoryBussiness, $search=null, $categorySelected=null, $viewList = false;
    public $keyInst;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->keyInst = request('token_inst');
        $this->listCategoryBussiness = $this->getAllCategoryBusiness($this->keyInst);

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
        $listBusiness = $this->getBusinessPublic($this->keyInst, $this->search, $this->categorySelected, $this->sort, $this->sortDirection);
        return view('livewire.front.show-public-business', compact('listBusiness'))
            ->extends('layouts.appPublic');
    }
}
