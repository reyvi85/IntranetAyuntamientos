<?php

namespace App\Http\Livewire;

use App\Models\InterestPhone;
use App\Traits\DataModelsComunityProvinces;
use App\Traits\DataModelsInstances;
use App\Traits\DataModelsPhone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class InterestPhonesComponent extends Component
{
    use DataModels, DataModelsPhone, DataModelsInstances, WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search, $name, $description, $phone, $image, $instance_id, $phoneSelected, $imagePhone;

    protected function rules(){
            return [
                'name'=>'required',
                'description'=>'nullable',
                'phone'=>'required',
                'image'=>'required|image',
                'instanceSelected'=>'required'
            ];
    }

    protected $messages =[
        'instance_id.required'=>'Debe seleccionar una instancia'
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setPatchToUpload('images/phones');
        $this->setConfigModal('Añadir teléfono');
    }

    public function resetProps(){
        $this->reset(['name', 'description', 'phone','image', 'imagePhone','modalModeDestroy']);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal();
    }

    public function store(){
        $this->validate();
        $imgPhone = $this->image->store($this->getPatchToUpload(), 'public');
        InterestPhone::create([
            'name'=>$this->name,
            'description'=>$this->description,
            'phone'=>$this->phone,
            'image'=>$imgPhone,
            'instance_id'=>$this->instanceSelected
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(InterestPhone $interestPhone){
        $this->setConfigModal('Editar teléfono', 'fa-edit', 'edit');
        $this->resetErrorBag();
        $this->modalModeDestroy = false;
        $this->phoneSelected = $interestPhone->id;
        $this->name = $interestPhone->name;
        $this->description = $interestPhone->description;
        $this->phone = $interestPhone->phone;
        $this->imagePhone = $interestPhone->image;
        $this->instanceSelected = $interestPhone->instance_id;
    }

    public function update_phone(InterestPhone $interestPhone){
        $this->validate();
        if($this->image){
            Storage::disk('public')->delete($interestPhone->image);
            $imgPhone = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $imgPhone = $interestPhone->image;
        }
        $interestPhone->fill([
            'name'=>$this->name,
            'description'=>$this->description,
            'phone'=>$this->phone,
            'image'=>$imgPhone,
            'instance_id'=>$this->instanceSelected
        ])->save();

        $this->emit('saveModal');
    }

    public function trash(InterestPhone $interestPhone){
        $this->modalModeDestroy =true;
        $this->phoneSelected = $interestPhone->id;
        $this->setConfigModal('Eliminar teléfono', 'fa-trash', 'trash');
        $this->name = $interestPhone->name;
    }

    public function destroy(InterestPhone $interestPhone){
        $interestPhone->delete();
        Storage::disk('public')->delete($interestPhone->image);
        $this->emit('saveModal');
        $this->resetProps();
    }


    public function render()
    {
        $telefonos = $this->getAllPhone($this->search, $this->instancias, $this->sort, $this->sortDirection);
        return view('livewire.administrator.interest-phones-component', compact('telefonos'))
            ->extends('layouts.app');
    }
}
