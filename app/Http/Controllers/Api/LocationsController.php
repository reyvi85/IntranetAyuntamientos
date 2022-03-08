<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Locations\LocationCategoryResource;
use App\Http\Resources\Locations\LocationCategoryResourceCollection;
use App\Http\Resources\Locations\LocationResource;
use App\Http\Resources\Locations\LocationResourceCollection;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Traits\DataAPI;
use App\Traits\DataAPIFront;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    use DataAPIFront;

    public function index(Request $request){
        return LocationResourceCollection::make($this->getLocations($request->search, $request->category,$request->sort, $request->perPage, $request->only));
    }

    public function locationShow(Request $request){
        $location = $this->getShowLocation($request->location);
        return LocationResource::make($location);
    }

    /**
     * CATEGORIAS
    **/
    public function locationCategoryIndex(){
        return LocationCategoryResourceCollection::make($this->getAllCategoryLocation());
    }

    public function locationCategoryShow(Request  $request){
        $locationCategory = $this->getShowCategoryLocation($request->locationCategory);
        return LocationCategoryResource::make($locationCategory);
    }
}
