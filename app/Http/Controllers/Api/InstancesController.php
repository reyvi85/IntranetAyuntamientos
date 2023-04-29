<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Instances\InstancesResource;
use App\Traits\DataModelsInstances;
use Illuminate\Http\Request;

class InstancesController extends Controller
{
    use DataModelsInstances;
    public function showInstance(Request $request)
    {
        return InstancesResource::make($this->getInstancePerKey($request->token_inst));
    }
}
