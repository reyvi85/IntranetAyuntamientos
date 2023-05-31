<?php

namespace App\Charts;

use App\Traits\DataModelsDashboard;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StatiscUsersTotalChart
{
    use DataModelsDashboard;
    protected $chart;
    public $data=[], $labels=[], $total;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $query = $this->getTotalUsers(request()->instancia);
        foreach ($query as $r){
            $this->labels[] = $r->rol;
            $this->data[] = $r->Total;
        }
        $this->total = collect($this->data)->sum();
    }

    public function build()
    {
        return $this->chart->pieChart()
            ->setTitle('Gestión de usuarios')
            ->setSubtitle($this->total.' usuarios')
            ->addData($this->data)
            ->setLabels($this->labels);
    }
}
