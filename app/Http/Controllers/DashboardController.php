<?php

namespace App\Http\Controllers;

use App\Charts\StatiscUsersPerMonthChart;
use App\Charts\StatiscUsersTotalChart;
use App\Charts\StatiscWarningChart;
use App\Charts\WarningsTotalChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(
        WarningsTotalChart $warningsTotalChart,
        StatiscWarningChart $statiscWarningChart,
        StatiscUsersTotalChart $statiscUsersTotalChart,
        StatiscUsersPerMonthChart $statiscUsersPerMonthChart
    ){
        return view('dashboard', [
            'statiscWarningChart'=>$statiscWarningChart->build(),
            'warningsTotalChart'=>$warningsTotalChart->build(),
            'statiscUsersTotalChart'=>$statiscUsersTotalChart->build(),
            'statiscUsersPerMonthChart'=>$statiscUsersPerMonthChart->build()
        ]);
    }
}
