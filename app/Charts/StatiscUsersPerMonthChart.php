<?php

namespace App\Charts;

use App\Traits\DataModelsDashboard;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StatiscUsersPerMonthChart
{
    use DataModelsDashboard;
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $gr =  $this->chart->barChart()
            ->setTitle('Registro de usuarios por meses')
            ->setSubtitle('Comportamiento de los usuarios')
            ->setXAxis(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']);
            foreach ($this->getStatiscPerMonthUsers() as $st){
                $gr->addData($st->rol, [$st->Enero, $st->Febrero, $st->Marzo, $st->Abril, $st->Mayo, $st->Junio, $st->Julio, $st->Agosto, $st->Septiembre, $st->Octubre, $st->Noviembre, $st->Diciembre]);
            }
        return $gr;
    }
}
