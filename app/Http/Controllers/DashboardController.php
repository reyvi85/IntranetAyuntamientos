<?php

namespace App\Http\Controllers;

use App\Charts\StatiscUsersPerMonthChart;
use App\Charts\StatiscUsersTotalChart;
use App\Charts\StatiscWarningChart;
use App\Charts\WarningsTotalChart;
use App\Traits\DataModelsInstances;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use DataModelsInstances;
    public function index(
        WarningsTotalChart $warningsTotalChart,
        StatiscWarningChart $statiscWarningChart,
        StatiscUsersTotalChart $statiscUsersTotalChart,
        StatiscUsersPerMonthChart $statiscUsersPerMonthChart
    ){

        return view('dashboard', [
            'listInstance'=>$this->getAllInstace(),
            'statiscWarningChart'=>$statiscWarningChart->build(),
            'warningsTotalChart'=>$warningsTotalChart->build(),
            'statiscUsersTotalChart'=>$statiscUsersTotalChart->build(),
            'statiscUsersPerMonthChart'=>$statiscUsersPerMonthChart->build()
        ]);
    }
}
