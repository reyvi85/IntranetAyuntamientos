<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Traits\DataModels;

class CategoryNotificationComponent extends Component
{
    use DataModels;

    public $search;

    public function mount(){
       $this->checkInstanceForUser();
    }

    public function render()
    {
        $listCategoryNotification = $this->getCategoryNotification($this->search,$this->instance_id, $this->sort, $this->sortDirection);
        return view('livewire.administrator.notifications.category-notification-component', compact('listCategoryNotification'))
            ->extends('layouts.app');
    }
}
