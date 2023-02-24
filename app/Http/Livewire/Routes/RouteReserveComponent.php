<?php

namespace App\Http\Livewire\Routes;

use App\Models\User;
use App\Traits\DataModels;
use App\Traits\DataModelsInstances;
use App\Traits\DataModelsRoute;
use App\Traits\DataModelsRouteReserve;
use App\Traits\DataModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class RouteReserveComponent extends Component
{
    use DataModels, DataModelsInstances, DataModelsRoute, DataModelsUser,DataModelsRouteReserve, WithPagination;

    public $search,
        $filterState,
        $routeSelected,
        $userSelected,
        $listRoutes,
        $listUsers;

    protected $listeners = ['userSelectedPerInstance'];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setConfigModal();
        $this->listUsers = collect();
    }

    public function userSelectedPerInstance(User $user){
        dd($user);
       // $this->userSelected = $user[0];
    }


    public function add(){

    }

    public function updatedInstanceSelected($instance){
        $this->listRoutes = $this->getRoutesPerInstance($instance);
        $this->emit('selectInstance', $instance);
    }

    public function render()
    {
        $reserves = $this->getAllReserve($this->search, $this->instancias, $this->filterState, $this->sort, $this->sortDirection);
        return view('livewire.administrator.routes.route-reserve-component', compact('reserves'));
    }
}
