<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use App\Traits\DataModelsInstances;
use App\Traits\DataModelsNotifications;
use Livewire\Component;
use App\Traits\DataModels;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    use DataModels, DataModelsNotifications,DataModelsInstances ,WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['categoryUDPT'];

    protected $rules = [
        'fechaPublicacion'=>'required',
        'titulo'=>'required',
        'description'=>'required',
        'instanceSelected'=>'required',
        'categoryNotification'=>'required',
    ];

    protected $messages = [
        'instanceSelected.required'=>'Es necesario seleccionar una instancia!',
        'categoryNotification.required'=>'Es necesario seleccionar una categoría!',
        'description.required'=>'Es necesario escribir una descripción!',
        'fechaPublicacion.required'=>'Es necesario escribir fecha de publicación!',
    ];

    public $search,
        $categorySelected,
        $categoryFilter,
        $listCategory,
        $listCategoryAddUdpt,
        $notificationSelected,
        $fechaPublicacion,
        $titulo,
        $description,
        $categoryNotification;

    public function mount(){
        $this->checkInstanceForUser();
        $this->fechaPublicacion = date('Y-m-d H:i:s');
        $this->setConfigModal('Añadir notificación');
        $this->listCategory = $this->getAllCategoryNotifications();
        $this->resetPage();
    }

    public function resetProps(){
        $this->reset(['titulo', 'description', 'categoryNotification', 'modalModeDestroy']);
        $this->modalModeDestroy = false;
    }

    public function categoryUDPT(){
        $this->listCategory = $this->getAllCategoryNotifications($this->instancias);
    }

    public function updatedInstancias($value)
    {
        $this->listCategory = $this->getAllCategoryNotifications($value);
    }

    public function updatedInstanceSelected()
    {
       // dd($this->instanceSelected);
       $this->resetErrorBag('categoryNotification');
       $this->listCategoryAddUdpt = $this->getAllCategoryNotifications($this->instanceSelected);
    }

    public function updatedCategoryFilter(){

       $this->listCategory = $this->getAllCategoryNotifications($this->instancias);
    }

    public function add(){
        $this->resetProps();
        $this->resetErrorBag();
        $this->listCategoryAddUdpt = $this->getAllCategoryNotifications();;
        $this->setConfigModal('Añadir notificación');
    }

    public function store(){
        $this->validate();
        Notification::create([
            'fecha_publicacion'=>$this->fechaPublicacion,
            'titulo'=>$this->titulo,
            'description'=>$this->description,
            'instance_id'=>$this->instanceSelected,
            'category_notification_id'=>$this->categoryNotification,
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(Notification $notification){
        $this->resetProps();
        $this->setConfigModal('Editar notificación', 'fa-edit', 'edit');
        $this->notificationSelected = $notification->id;
        $this->fechaPublicacion = $notification->fecha_publicacion;
        $this->titulo = $notification->titulo;
        $this->description = $notification->description;
        $this->instanceSelected = $notification->instance_id;
        $this->categoryNotification = $notification->category_notification_id;
        $this->listCategoryAddUdpt = $this->getAllCategoryNotifications($notification->instance_id);
    }

    public function update_notification(Notification $notification){
        $this->validate();
        $notification->fill([
            'fecha_publicacion'=>$this->fechaPublicacion,
            'titulo'=>$this->titulo,
            'description'=>$this->description,
            'instance_id'=>$this->instanceSelected,
            'category_notification_id'=>$this->categoryNotification,
        ])->save();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function trash(Notification $notification){
        $this->setConfigModal('Eliminar notificación', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->titulo = $notification->titulo;
        $this->notificationSelected = $notification->id;
    }

    public function destroy(Notification $notification){
        $notification->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function render()
    {
        $notifications = $this->getAllNotifications($this->search, $this->instancias, $this->categoryFilter, $this->sort, $this->sortDirection);
        return view('livewire.administrator.notifications.notification-component', compact('notifications'));
    }
}
