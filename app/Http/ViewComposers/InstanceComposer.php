<?php


namespace App\Http\ViewComposers;


use Illuminate\Contracts\View\View;

class InstanceComposer
{
    public function compose(View $view)
    {

        $view->with('saludo', 'Hola al mundo');
    }
}
