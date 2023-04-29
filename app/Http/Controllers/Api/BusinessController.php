<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Business\BusinessCategoryResource;
use App\Http\Resources\Business\BusinessCategoryResourceCollection;
use App\Http\Resources\Business\BusinessResource;
use App\Http\Resources\Business\BusinessResourceCollection;
use App\Models\Busine;
use App\Traits\DataAPIFront;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    use DataAPIFront;
    /**
     * lista de negocios
    **/
    public function index(Request $request){
        return BusinessResourceCollection::make($this->getAllBusiness($request->search, $request->category, $request->sort));
    }
    /**
     * Ver negocio
    **/
    public function businessShow(Busine $busine){
        return BusinessResource::make($busine);
    }

    /**
     * lista Categorias de negocios
    **/
    public function businessCategoryIndex(){
        return BusinessCategoryResourceCollection::make($this->getAllBusinessCategory()->where('business_count','!=',0));
    }

    /**
     * Ver Categoría
    **/
    public function businessCategoryShow(){
        $categoryBusine  = $this->getBusinessCategory(request()->categoryBusine);
        return BusinessCategoryResource::make($categoryBusine);
    }
}
