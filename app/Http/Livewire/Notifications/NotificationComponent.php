<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    use DataModels, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;

    public function mount(){
        $this->resetPage();
    }

    public function render()
    {
        $notifications = $this->getAllNotifications();
        return view('livewire.administrator.notification-component', compact('notifications'))
            ->extends('layouts.app');
    }
}
