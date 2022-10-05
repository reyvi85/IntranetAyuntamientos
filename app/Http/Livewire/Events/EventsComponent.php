<?php

namespace App\Http\Livewire\Events;

use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EventsComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;

    public function render()
    {
        return view('livewire.events.events-component');
    }
}
