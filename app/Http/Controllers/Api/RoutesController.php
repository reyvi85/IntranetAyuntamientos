<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Routes\RouteCategoryResourseCollection;
use App\Http\Resources\Routes\RouteReserveResourceCollection;
use App\Http\Resources\Routes\RouteResourseCollection;
use App\Mail\ConfirmRouteReserve;
use App\Models\RouteReserve;
use App\Traits\DataAPIFront;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function reserves(Request $request){
        return RouteReserveResourceCollection::make($this->getRouteReserve($request->user));
    }

    public function reserveStore(Request $request)
    {
        $json = json_decode($request->data);
        foreach ($json as $reserve){
            $rr = RouteReserve::create([
                'user_id'=>$reserve->user_id,
                'route_id'=>$reserve->route_id,
                'num_person'=>$reserve->num_person,
                'fecha_reserva'=>$reserve->fecha_reserva,
                'instance_id'=>$reserve->instance_id,
                'state'=>true,
                'cost'=>$reserve->cost
            ]);
            Mail::to($rr->user->email)->send(new ConfirmRouteReserve($rr));
        }
        return response()->json([
            'message'=>'Se realizaron todas las reservas con éxito!'
        ], 201);
    }

}
