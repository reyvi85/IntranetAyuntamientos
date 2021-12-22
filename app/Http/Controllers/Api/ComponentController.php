<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Component\Business\BusinessCategoryResourceCollection;
use App\Http\Resources\Component\Business\BusinessResourceCollection;
use App\Http\Resources\Component\Business\BusinessCategoryResource;
use App\Traits\DataFront;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    use DataFront;



    public function getBisnessComponent(Request $request){
       return BusinessResourceCollection::make($this->getBusinessPublic($request->token_inst, $request->search, $request->category, $request->perPage));
    }

    public function getCategoriesBusiness(Request $request)
    {
        return BusinessCategoryResourceCollection::make($this->getAllCategoryBusiness($request->token_inst));
    }


}
