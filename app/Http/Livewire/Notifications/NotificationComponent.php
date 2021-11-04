<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
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
        $this->setConfigModal();
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

    public function add(){

    }

    public function render()
    {
        $nt = Notification::first();
        $a = $nt->instance;
        //dd()
        $notifications = $this->getAllNotifications($this->search, $this->instancias, $this->categorySelected, $this->sort, $this->sortDirection);
        return view('livewire.administrator.notifications.notification-component', compact('notifications'));
    }
}
