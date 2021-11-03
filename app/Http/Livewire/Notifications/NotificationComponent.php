<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    use DataModels, WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['categoryUDPT'];

    public $search, $instancias, $categorySelected, $listCategory;

    public function mount(){
        $this->checkInstanceForUser();
        $this->listCategory = $this->getAllCategoryNotifications($this->instancias);
        $this->resetPage();
    }

    public function categoryUDPT(){
        $this->listCategory = $this->getAllCategoryNotifications($this->instancias);
    }

    public function updatedInstancias()
    {
        $this->listCategory = $this->getAllCategoryNotifications($this->instancias);
    }

    public function render()
    {
        $notifications = $this->getAllNotifications($this->search, $this->instancias, $this->categorySelected, $this->sort, $this->sortDirection);
        //istCategory = $this->listCategory;
        return view('livewire.administrator.notification-component', compact('notifications'))
            ->extends('layouts.app');
    }
}
