<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class InterestPhonesComponent extends Component
{
    use DataModels, WithPagination;

    public $name, $description, $phone, $instanceSelected, $phoneSelected, $listInstance;

    protected $rules = [
        'name'=>'required',
        'description'=>'nullable',
        'phone'=>'required'
    ];

    public function render()
    {
        return view('livewire.interest-phones-component');
    }
}
