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
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    use DataAPI;

    public function index(Request $request){
        return LocationResourceCollection::make($this->getLocations($request->search, $request->category,$request->sort, $request->perPage));
    }

    public function locationShow(Location $location){
        return LocationResource::make($location);
    }

    /**
     * CATEGORIAS
    **/
    public function locationCategoryIndex(){
        return LocationCategoryResourceCollection::make($this->getAllCategoryLocation());
    }

    public function locationCategoryShow(LocationCategory $locationCategory){
        return LocationCategoryResource::make($locationCategory);
    }
}
