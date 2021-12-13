<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Widgets\WidgetsResource;
use App\Http\Resources\Widgets\WidgetsResourceCollection;
use App\Models\Widget;
use App\Traits\DataAPI;
use Illuminate\Http\Request;

class WidgetsController extends Controller
{
    use DataAPI;
    public function index(Request $request){
        return  WidgetsResourceCollection::make($this->getAllWidgets($request->search, $request->sort, $request->perPage));
    }

    public function show(Widget $widget){
        if ($widget->status == false){
            abort(404);
        }
        return WidgetsResource::make($widget);
    }
}
