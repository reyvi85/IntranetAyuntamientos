<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Routes\RouteCategoryResourseCollection;
use App\Http\Resources\Routes\RouteResourseCollection;
use App\Traits\DataAPIFront;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    use DataAPIFront;
    public function index(Request $request)
    {
        return RouteResourseCollection::make($this->getAllRoutes($request->search, $request->category));
    }

    public function categories(){
        return RouteCategoryResourseCollection::make($this->getAllRoutesCategory());
    }
}
