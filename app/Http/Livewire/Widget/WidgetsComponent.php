<?php

namespace App\Http\Livewire\Widget;

use App\Models\Widget;
use App\Traits\DataModels;
use App\Traits\DataModelsInstances;
use App\Traits\DataModelsWidgets;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class WidgetsComponent extends Component
{
    use DataModels, DataModelsWidgets,DataModelsInstances ,WithFileUploads, WithPagination;

    public $search, $widgetSelected, $imageWidget, $img,
        $titulo,
        $subtitulo,
        $image,
        $embed,
        $enlace,
        $active;

    protected $rules = [
        'titulo'=>'required',
        'subtitulo'=>'required',
        'image'=>'required|image|max:3072',
        'enlace'=>'required|url',
        'instanceSelected'=>'required'

    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setPatchToUpload('images/widgets/');
        $this->setConfigModal('Añadir widget');
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

    public function resetProps(){
        $this->resetErrorBag();
        $this->reset(['titulo','subtitulo','image','img','enlace','active','modalModeDestroy','imageWidget','widgetSelected']);
    }

    private function _getData(){
        return [
            'titulo'=>$this->titulo,
            'subtitulo'=>$this->subtitulo,
            'image'=>$this->img,
            'embed'=>$this->embed,
            'enlace'=>$this->enlace,
            'active'=>$this->active,
            'slug'=>Str::slug($this->titulo),
            'instance_id'=>$this->instanceSelected
        ];
    }

    public function add(){
        $this->resetProps();
        $this->setConfigModal('Añadir widget');
        $this->active = true;
    }

    public function store(){
        $this->validate();
        $this->img = $this->image->store($this->getPatchToUpload(), 'public');
        Widget::create($this->_getData());
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(Widget $widget){
        $this->resetProps();
        $this->setConfigModal('Editar widget', 'fa-edit', 'edit');
        $this->widgetSelected = $widget->id;
        $this->titulo = $widget->titulo;
        $this->subtitulo = $widget->subtitulo;
        $this->imageWidget = $widget->image;
        $this->enlace = $widget->enlace;
        $this->embed = $widget->embed;
        $this->active = $widget->active;
        $this->instanceSelected = $widget->instance_id;
    }

    public function update_widget(Widget $widget){
        $this->validate([
            'titulo'=>'required',
            'subtitulo'=>'required',
            'image'=>'nullable|image|max:3072',
            'enlace'=>'required|url',
            'instanceSelected'=>'required'
        ]);
        if($this->image){
            Storage::disk('public')->delete($widget->image);
            $this->img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $this->img = $widget->image;
        }
        $widget->fill($this->_getData())->save();
        $this->emit('saveModal');
    }

    public function trash(Widget $widget){
        $this->modalModeDestroy = true;
        $this->setConfigModal('Eliminar widget', 'fa-trash', 'trash');
        $this->widgetSelected = $widget->id;
        $this->titulo = $widget->titulo;
    }

    public function destroy(Widget $widget){
        Storage::disk('public')->delete($widget->image);
        $widget->delete();
        $this->emit('saveModal');
    }

    public function render()
    {
        $widgets = $this->getAllWidgets($this->search, $this->instancias, $this->sort, $this->sortDirection);
        return view('livewire.administrator.widget.widgets-component', compact('widgets'))
            ->extends('layouts.app');
    }
}
