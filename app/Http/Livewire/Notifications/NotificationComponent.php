<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    use DataModels, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $instancias, $categorySelected;

    public function mount(){
        $this->checkInstanceForUser();
        $this->resetPage();
    }

    public function render()
    {
        $notifications = $this->getAllNotifications($this->search, $this->instancias, $this->categorySelected, $this->sort, $this->sortDirection);
        $listCategory = $this->getAllCategoryNotifications($this->instancias);
        return view('livewire.administrator.notification-component', compact('notifications', 'listCategory'))
            ->extends('layouts.app');
    }
}
