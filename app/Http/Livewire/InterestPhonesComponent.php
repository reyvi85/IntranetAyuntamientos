<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class InterestPhonesComponent extends Component
{
    use DataModels, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search, $name, $description, $phone, $instance_id, $phoneSelected;

    protected function rules(){
        if(Auth::user()->rol != 'Super-Administrador'){
            return [
                'name'=>'required',
                'description'=>'nullable',
                'phone'=>'required'
            ];
        }else{
            return [
                'name'=>'required',
                'description'=>'nullable',
                'phone'=>'required',
                'instance_id'=>'required'
            ];
        }
    }

    public function mount(){
        $this->checkInstanceForUser();
    }

    protected $rules = [

    ];

    public function render()
    {
        $telefonos = $this->getAllPhone($this->search, $this->sort, $this->sortDirection);
        return view('livewire.administrator.interest-phones-component', compact('telefonos'))
            ->extends('layouts.app');
    }
}
