<?php


namespace App\Traits;


use App\Models\Busine;
use App\Models\Event;
use App\Models\Location;
use App\Models\Post;
use App\Models\Route;
use App\Models\User;
use App\Models\Warning;
use App\Models\WarningState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait DataModelsDashboard
{
    public function getStateWithWarning($instancia = null){
        return WarningState::withCount(['warnings'=>function($q) use($instancia){
                    $q->where(function ($q) use($instancia){
                if (Auth::user()->rol != 'Super-Administrador'){
                    $q->where('warnings.instance_id', '=',Auth()->user()->instance_id);
                }else{
                    $q->when($instancia, function ($qr) use($instancia){
                        $qr->where('warnings.instance_id', $instancia);
                    });
                }
            });
        }])
            ->get();
    }

    public function getYearsToWarnings(){
        return Warning::select(
            DB::raw('DISTINCT YEAR(created_at) as year')
        )
            ->orderBy('year', 'DESC')
            ->GetInstance()
            ->get();
    }

    public function getStatiscPerMonthWarning($instancia=null){
        return WarningState:: //DB::table('warning_states')
            select(
                DB::raw('warning_states.name as Estado'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 1 THEN warnings.id ELSE NULL END) as Enero'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 2 THEN warnings.id ELSE NULL END) as Febrero'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 3 THEN warnings.id ELSE NULL END) as Marzo'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 4 THEN warnings.id ELSE NULL END) as Abril'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 5 THEN warnings.id ELSE NULL END) as Mayo'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 6 THEN warnings.id ELSE NULL END) as Junio'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 7 THEN warnings.id ELSE NULL END) as Julio'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 8 THEN warnings.id ELSE NULL END) as Agosto'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 9 THEN warnings.id ELSE NULL END) as Septiembre'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 10 THEN warnings.id ELSE NULL END) as Octubre'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 11 THEN warnings.id ELSE NULL END) as Noviembre'),
                DB::raw('COUNT(CASE WHEN MONTH(warnings.created_at) = 12 THEN warnings.id ELSE NULL END) as Diciembre')
            )
            ->FilterInstance($instancia)
            ->join('warnings','warning_states.id', '=', 'warnings.warning_state_id')
            ->groupBy('warning_states.name')
            ->get();
    }

    public function getTotalUsers($instancia = null){
        return User::select(
            'rol', DB::raw('COUNT(*) as Total')
            )
            ->FilterInstance($instancia)
            ->groupBy('rol')
            ->get();
    }

    public function getStatiscPerMonthUsers($instancia=null){
        return User::
        select('rol',
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN id ELSE NULL END) as Enero'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN id ELSE NULL END) as Febrero'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN id ELSE NULL END) as Marzo'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN id ELSE NULL END) as Abril'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN id ELSE NULL END) as Mayo'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN id ELSE NULL END) as Junio'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN id ELSE NULL END) as Julio'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN id ELSE NULL END) as Agosto'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN id ELSE NULL END) as Septiembre'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN id ELSE NULL END) as Octubre'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN id ELSE NULL END) as Noviembre'),
            DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN id ELSE NULL END) as Diciembre')
        )
            ->FilterInstance($instancia)
            ->groupBy('rol')
            ->get();
    }
    /**
     * Most Popular method
    */

    public function getMostPopular($model, $campos=array(), $instancia=null, $cantidad = 5){
        return $model::select($campos)
            ->FilterInstance($instancia)
            ->orderBy('hit', 'Desc')
            ->limit($cantidad)
            ->get();
    }

    /**
     *  P O S T
    */
    public function getPostMostPopular($instancia=null, $cantidad = 5){
        return $this->getMostPopular(Post::class, ['titulo', 'hit'], $instancia, $cantidad);
    }

    /**
     * L O C A T I O N S
    */

    public function getLocationsMostPopular($instancia=null, $cantidad = 5){
        return $this->getMostPopular(Location::class, ['name', 'hit'], $instancia, $cantidad);
    }

    /**
     * B U S I N E S
    */

    public function getBusinesMostPopular($instancia=null, $cantidad = 5){
        return $this->getMostPopular(Busine::class, ['name', 'hit'], $instancia, $cantidad);
    }

    /**
     * E V E N T S
     */

    public function getEventsMostPopular($instancia=null, $cantidad = 5){
        return $this->getMostPopular(Event::class, ['titulo', 'hit'], $instancia, $cantidad);
    }
/**
     * E V E N T S
     */

    public function getRoutesMostPopular($instancia=null, $cantidad = 5){
        return $this->getMostPopular(Route::class, ['name', 'hit'], $instancia, $cantidad);
    }

    public function increments($model, $id){
        $model::find($id)->increment('hit');
        return response()->json([
            'message'=>'Incrementado registro!'
        ], 201);
    }

    public function getCounter($model, $id){
        switch ($model){
            case 'post':
               return $this->increments(Post::class, $id);
            case 'location':
                return $this->increments(Location::class, $id);
            case 'business':
                return $this->increments(Busine::class, $id);
            case 'event':
                return $this->increments(Event::class, $id);
            case 'route':
                return $this->increments(Route::class, $id);
            default:
                return response()->json([
                    'message'=>'La solicitud no fue válida!'
                ], 400);
        }
    }

    public function getUsuerPerEmail($email){
        return User::where('email', 'like','%'.$email.'%')->first();
    }

}

