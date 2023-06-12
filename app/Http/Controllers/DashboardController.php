<?php

namespace App\Http\Controllers;

use App\Charts\StatiscUsersPerMonthChart;
use App\Charts\StatiscUsersTotalChart;
use App\Charts\StatiscWarningChart;
use App\Charts\WarningsTotalChart;
use App\Models\Post;
use App\Models\Route;
use App\Traits\DataModelsDashboard;
use App\Traits\DataModelsInstances;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use DataModelsInstances, DataModelsDashboard;
    public function index(
        WarningsTotalChart $warningsTotalChart,
        StatiscWarningChart $statiscWarningChart,
        StatiscUsersTotalChart $statiscUsersTotalChart,
        StatiscUsersPerMonthChart $statiscUsersPerMonthChart
    ){
        $instancia = request()->instancia;
        return view('dashboard', [
            'listInstance'=>$this->getAllInstace(),
            'statiscWarningChart'=>$statiscWarningChart->build(),
            'warningsTotalChart'=>$warningsTotalChart->build(),
            'statiscUsersTotalChart'=>$statiscUsersTotalChart->build(),
            'statiscUsersPerMonthChart'=>$statiscUsersPerMonthChart->build(),
            'posts'=>$this->getPostMostPopular($instancia),
            'locations'=>$this->getLocationsMostPopular($instancia),
            'busines'=>$this->getBusinesMostPopular($instancia),
            'events'=>$this->getEventsMostPopular($instancia),
            'routes'=>$this->getRoutesMostPopular($instancia)
        ]);
    }

    public function counterHit($model, $id){
        return $this->getCounter($model, $id);
    }
}
