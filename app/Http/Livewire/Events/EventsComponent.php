<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use App\Traits\DataModels;
use App\Traits\DataModelsEvents;
use App\Traits\DataModelsInstances;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EventsComponent extends Component
{
    use DataModels, DataModelsEvents, DataModelsInstances, WithPagination, WithFileUploads;
    protected $listeners = ['getLatitudeForInput',  'getLongitudeForInput', 'addCategoryEvents'];

    public $search, $eventSelected, $imageEvent, $listCategory, $categoryFilter,$categorySelected,
        $titulo,
        $image,
        $description,
        $lat,
        $lng,
        $web,
        $fecha_inicio,
        $fecha_fin;

    protected $rules = [
        'titulo'=>'required',
        'description'=>'required',
        'web'=>'nullable|url',
        'image'=>'required|image',
        'fecha_inicio'=>'required|date_format:"Y-m-d"',
        'fecha_fin'=>'required|date_format:"Y-m-d"|after:fecha_inicio',
        'instanceSelected'=>'required',
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->fecha_inicio = date('Y-m-d');
        $this->fecha_fin = date('Y-m-d');
        $this->setPatchToUpload('images/events');
        $this->listCategory = $this->getAllCategoryEvents();
    }

    public function getLatitudeForInput($value)
    {
        if(!is_null($value))
            $this->lat = $value;
    }
    public function getLongitudeForInput($value)
    {
        if(!is_null($value))
            $this->lng = $value;
    }

    public function addCategoryEvents(){
        $this->listCategory = $this->getAllCategoryEvents();
    }

    public function resetProps(){
        $this->reset(['eventSelected', 'imageEvent', 'titulo', 'image', 'description', 'lat', 'lng', 'web', 'fecha_inicio', 'fecha_fin', 'categorySelected']);
    }

    public function add(){
        $this->resetProps();
        if(auth()->user()->rol =='Super-Administrador'){
            $this->reset('instanceSelected');
        }
        $this->emit('initMap', config('maps.lat_default'), config('maps.lng_default'));
        $this->lat = config('maps.lat_default');
        $this->lng = config('maps.lng_default');
    }

    public function store(){
        $this->validate();
        $img = $this->image->store($this->getPatchToUpload(), 'public');
        Event::create([
            'titulo'=>$this->titulo,
            'imagen'=>$img,
            'description'=>$this->description,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'link'=>$this->web,
            'f_inicio'=>$this->fecha_inicio,
            'f_fin'=>$this->fecha_fin,
            'instance_id'=>$this->instanceSelected,
            'event_category_id'=>$this->categorySelected
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(Event $event){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->eventSelected = $event->id;
        $this->titulo = $event->titulo;
        $this->imageEvent = $event->imagen;
        $this->description = $event->description;
        $this->lat = $event->lat;
        $this->lng = $event->lng;
        $this->web = $event->link;
        $this->fecha_inicio = $event->f_inicio;
        $this->fecha_fin = $event->f_fin;
        $this->instanceSelected = $event->instance_id;
        $this->categorySelected = $event->event_category_id;
        $this->emit('initMap', $this->lat, $this->lng);
    }

    public function update_event(Event $event){
        $this->validate([
            'titulo'=>'required',
            'description'=>'required',
            'web'=>'nullable|url',
            'image'=>'nullable|image',
            'fecha_inicio'=>'required|date_format:"Y-m-d"',
            'fecha_fin'=>'required|date_format:"Y-m-d"|after:fecha_inicio',
            'instanceSelected'=>'required',
        ]);
        if($this->image){
            Storage::disk('public')->delete($event->imagen);
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $img = $event->imagen;
        }
        $event->fill([
            'titulo'=>$this->titulo,
            'imagen'=>$img,
            'description'=>$this->description,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'link'=>$this->web,
            'f_inicio'=>$this->fecha_inicio,
            'f_fin'=>$this->fecha_fin,
            'instance_id'=>$this->instanceSelected,
            'event_category_id'=>$this->categorySelected
        ])->save();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function trash(Event $event){
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->eventSelected = $event->id;
        $this->titulo = $event->titulo;
    }

    public function destroy(Event $event){
        Storage::disk('public')->delete($event->imagen);
        $event->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function render()
    {
        $events = $this->getAllEvents($this->search,$this->instancias, $this->categoryFilter ,$this->sort);
        return view('livewire.administrator.events.events-component', compact('events'));
    }
}
