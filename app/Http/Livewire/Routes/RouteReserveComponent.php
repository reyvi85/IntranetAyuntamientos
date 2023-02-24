<?php

namespace App\Http\Livewire\Routes;

use App\Models\RouteReserve;
use App\Models\User;
use App\Traits\DataModels;
use App\Traits\DataModelsInstances;
use App\Traits\DataModelsRoute;
use App\Traits\DataModelsRouteReserve;
use App\Traits\DataModelsUser;
use App\Traits\Helper;
use Livewire\Component;
use Livewire\WithPagination;

class RouteReserveComponent extends Component
{
    use DataModels,Helper ,DataModelsInstances, DataModelsRoute, DataModelsUser,DataModelsRouteReserve, WithPagination;

    public $search,
        $filterState,
        $routeSelected,
        $dia, $mes, $year, $hrs, $min,
        $userSelected,
        $viewReserve = false,
        $reserve,
        $listRoutes;

    protected $listeners = ['userSelectedPerInstance'];
    protected $rules = [
        'userSelected'=>'required',
        'instanceSelected'=>'required',
        'routeSelected'=>'required',
        'dia'=>'required',
        'mes'=>'required',
        'year'=>'required',
        'hrs'=>'required',
        'min'=>'required',
    ];
    protected $messages =[
        'userSelected.required'=>'Debe de seleccionar un usuario!',
        'instanceSelected.required'=>'Debe seleccionar una instancia!',
        'routeSelected.required'=>'Debe seleccionar una ruta!',
        'year.required'=>'El campo año es obligatorio.',
        'hrs.required'=>'El campo hora es obligatorio.',
        'min.required'=>'El campo minutos es obligatorio.',
    ];


    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->listUsers = collect();
    }

    public function userSelectedPerInstance(User $user){
       $this->userSelected = $user;
    }

    public function resetProps(){
        $this->reset(['routeSelected', 'userSelected', 'dia', 'mes', 'year', 'hrs', 'min', 'viewReserve', 'modalModeDestroy']);
        //$this->resetPage();
    }

    protected function encodeTime(){
        return $this->year.'-'.$this->mes.'-'.$this->dia.' '.$this->hrs.':'.$this->min.':00';
    }

    protected function decodeTime($time){
        $data = explode(' ', $time);
        $dataFecha = $data[0];
        $dataHora = $data[1];

        $fecha = explode('-', $dataFecha);
        $hora = explode(':', $dataHora);
        //dd($hora[0]);
        $this->dia = $fecha[2];
        $this->mes = $fecha[1];
        $this->year = $fecha[0];
        $this->hrs = $hora[0];
        $this->min = $hora[1];
    }


    public function add(){
        $this->resetProps();
        $this->setConfigModal();
        $this->emit('selectInstance', $this->instanceSelected);
        $this->emit('resetUserSelected');
    }

    public function store(){
        $this->validate();
        RouteReserve::create([
            'user_id'=>$this->userSelected->id,
            'route_id'=>$this->routeSelected,
            'fecha_reserva'=>$this->encodeTime()
        ]);
        $this->resetProps();
        $this->emit('resetUserSelected');
        $this->emit('saveModal');
    }

    public function edit(RouteReserve $routeReserve){
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');

        $this->instanceSelected = $routeReserve->route->instance_id;

        $this->listRoutes = $this->getRoutesPerInstance($this->instanceSelected);
        $this->userSelected = $routeReserve->user_id;
        $this->routeSelected = $routeReserve->id;
        $this->decodeTime($routeReserve->fecha_reserva);

        $this->emit('selectInstance', $this->instanceSelected);
        $this->emit('selectUser', $routeReserve->user_id);
    }

    public function updatedInstanceSelected($instance){
        $this->listRoutes = $this->getRoutesPerInstance($instance);
        $this->reset('routeSelected');
        $this->emit('selectInstance', $instance);
    }

    public function reserveUdpt(RouteReserve $routeReserve){
            $this->validate();
            $routeReserve->fill([
                'user_id'=>$this->userSelected->id,
                'route_id'=>$this->routeSelected,
                'fecha_reserva'=>$this->encodeTime()
            ])->save();
        $this->resetProps();
        $this->emit('resetUserSelected');
        $this->emit('saveModal');
    }

    public function trash(RouteReserve $routeReserve){
        $this->viewReserve = false;
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->modalModeDestroy = true;
        $this->routeSelected = $routeReserve->id;
    }

    public function destroy(RouteReserve $routeReserve){
        $routeReserve->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function viewReserve(RouteReserve $routeReserve){
        $this->setConfigModal('Ver reserva / '.$routeReserve->fecha_reserva, 'fa-eye', 'view');
        $this->modalModeDestroy = false;
        $this->viewReserve = true;
        $this->reserve = $routeReserve;
    }

    public function render()
    {
        $meses = $this->getMeses();
        $reserves = $this->getAllReserve($this->search, $this->instancias, $this->filterState, $this->sort, $this->sortDirection);
        return view('livewire.administrator.routes.route-reserve-component', compact('reserves', 'meses'));
    }
}
