<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Instances\InstancesResource;
use App\Http\Resources\Instances\InstancesResourceCollection;
use App\Traits\DataModelsInstances;
use Illuminate\Http\Request;

class InstancesController extends Controller
{
    use DataModelsInstances;

    public function index(Request $request){
        return InstancesResourceCollection::make($this->getAllInstace());
    }

    public function showInstance(Request $request)
    {
        return InstancesResource::make($this->getInstancePerKey($request->token_inst));
    }

    public function user(Request $request)
    {
        return InstancesResourceCollection::make(auth()->user()->instances);
    }

    public function AddUserInstancia(Request $request)
    {
        $add = auth()->user()->instances()->sync($request->instances);
        if ($add){
            return response()->json([
                'message'=>'Nuevas instancias añadidas con éxito'
            ], 201);
        }
    }
}
