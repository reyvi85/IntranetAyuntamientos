<?php

namespace App\Charts;

use App\Traits\DataModelsDashboard;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StatiscWarningChart
{
    use DataModelsDashboard;
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {

        $gr = $this->chart->barChart()
            ->setTitle('Avisos por meses')
            ->setSubtitle('Comportamiento de los avisos')
            ->setXAxis(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']);
        foreach ($this->getStatiscPerMonthWarning() as $st){
           // dd($st);
            $gr->addData($st->Estado, [$st->Enero, $st->Febrero, $st->Marzo, $st->Abril, $st->Mayo, $st->Junio, $st->Julio, $st->Agosto, $st->Septiembre, $st->Octubre, $st->Noviembre, $st->Diciembre]);
        }
        return $gr;

    }
}
