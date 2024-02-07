<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Instances\InstancesResource;
use App\Http\Resources\Instances\InstancesResourceCollection;
use App\Traits\DataAPIFront;
use App\Traits\DataModelsInstances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstancesController extends Controller
{
    use DataAPIFront;

    public function index(Request $request){
        return InstancesResourceCollection::make($this->getAllInstace());
    }

    public function showInstance(Request $request)
    {
        return InstancesResource::make($this->getInstancePerKey($request->token_inst));
    }

    public function user(Request $request)
    {
        $data = $this->getInstancesPerUser();
        $data->push(auth()->user()->instance);
           return InstancesResourceCollection::make($data);
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
