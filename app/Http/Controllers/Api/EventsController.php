<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Events\EventCategoryResourceCollection;
use App\Http\Resources\Events\EventsResourceCollection;
use App\Traits\DataAPIFront;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    use DataAPIFront;

    public function index(Request $request){
        return EventsResourceCollection::make($this->getAllEvents($request->search, $request->category));
    }



    public function categories(){
        return EventCategoryResourceCollection::make($this->getAllCategoryEvents());
    }
}
