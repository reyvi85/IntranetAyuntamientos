<?php

namespace App\Http\Controllers;

use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use Helper;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $optMenu = (Auth::user()->isRole('Super-Administrador'))?$this->modulosApp():$this->getOptionMenu();

        return view('home', compact('optMenu'));
    }
}
