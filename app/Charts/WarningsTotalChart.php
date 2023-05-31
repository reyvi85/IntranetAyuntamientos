<?php

namespace App\Charts;

use App\Traits\DataModelsDashboard;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WarningsTotalChart
{
    use DataModelsDashboard;

    protected $chart;
    public $data=[], $labels=[], $total;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $query = $this->getStateWithWarning(request()->instancia);
        foreach ($query as $r){
            $this->data[] = $r->warnings_count;
            $this->labels[] = $r->name;
        }
        $this->total = collect($this->data)->sum();
    }

    public function build()
    {
        return $this->chart->pieChart()
            ->setTitle('Gestión de avisos')
            ->setSubtitle($this->total.' avisos')
            ->addData($this->data)
            ->setLabels($this->labels);
    }
}
