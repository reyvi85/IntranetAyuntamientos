<?php

namespace App\Http\Livewire\Dashboard;

use App\Charts\WarningsTotalChart;
use App\Traits\DataModelsAvisos;
use Livewire\Component;



class AvisosComponent extends Component
{
    use DataModelsAvisos;
    public $chart;
    public function mount(WarningsTotalChart $gr)
    {
        $this->chart = $gr->build();
    }

    public function render()
    {
        $chart = $this->chart;
        return view('livewire.administrator.dashboard.avisos-component', compact($chart));
    }
}
