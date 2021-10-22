<?php

namespace App\Http\Livewire\Business;

use Livewire\Component;
use App\Traits\DataModels,
    Livewire\WithPagination;

class ShowPublicBusiness extends Component
{
    use DataModels, WithPagination;

    public $listCategoryBussiness, $search=null, $categorySelected=null, $viewList = false;
    public $keyInst;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->keyInst = request('token_inst');
        $this->listCategoryBussiness = $this->getAllCategoryBusiness();

    }

    public function render()
    {
        $listBusiness = $this->getBusinessPublic($this->keyInst, $this->search, $this->categorySelected, $this->sort, $this->sortDirection);
        return view('livewire.front.show-public-business', compact('listBusiness'))
            ->extends('layouts.appPublic');
    }
}
