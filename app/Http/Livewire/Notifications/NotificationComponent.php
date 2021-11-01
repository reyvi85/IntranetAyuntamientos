<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class NotificationComponent extends Component
{
    public function render()
    {
        return view('livewire.administrator.notification-component')
            ->extends('layouts.app');
    }
}
