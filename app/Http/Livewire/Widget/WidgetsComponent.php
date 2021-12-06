<?php

namespace App\Http\Livewire\Widget;

use App\Models\Widget;
use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class WidgetsComponent extends Component
{
    use DataModels, WithFileUploads, WithPagination;

    public $search, $widgetSelected, $imageWidget,
        $titulo,
        $subtitul,
        $image,
        $type,
        $enlace,
        $active;

    public function mount(){
        $this->checkInstanceForUser();
        $this->setPatchToUpload('images/widgets/');
        $this->setConfigModal();
    }

    public function update_state(Widget $widget, $state){
        $campos = collect(['active']);
        if(!is_array($state) && $campos->contains($state)){
            $widget->fill([
                $state=>($widget->$state == 1)?0:1
            ])->save();
        }
        else{
            abort(403);
        }
    }

    public function render()
    {
        $widgets = $this->getAllWidgets($this->search, $this->instancias, $this->sort, $this->sortDirection);
        return view('livewire.administrator.widget.widgets-component', compact('widgets'))
            ->extends('layouts.app');
    }
}
