<?php
/**
 * Created by PhpStorm.
 * User: reyvi
 * Date: 9/12/2021
 * Time: 15:19
 */

namespace App\Traits;


use App\Models\Busine;
use App\Models\CategoryBusine;
use App\Models\CategoryNotification;
use App\Models\InterestPhone;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Warning;
use App\Models\WarningAnswer;
use App\Models\WarningCategory;
use App\Models\WarningState;
use App\Models\Widget;
use Illuminate\Database\Eloquent\Builder;

trait DataAPIFront
{
    public function getWarnings($search=null, $rangoFecha=null, $category = null, $subCategory = null , $estado=null, $sort=null, $perPage=15){
        return Warning::withoutGlobalScopes()
            ->with(['warning_state', 'warning_answers','warning_sub_category', 'warning_sub_category.warning_category'])
            ->withCount('warning_answers')
            ->when($search, function ($q) use($search){
                $q->where('asunto','like', '%'.$search.'%')
                    ->orWhere('description','like', '%'.$search.'%')
                    ->orWhere('ubicacion','like', '%'.$search.'%');
            })
            ->when($estado, function ($q) use($estado){
                $q->where('warning_state_id', $estado);
            })

            ->when($rangoFecha, function ($q) use($rangoFecha){
                $aux = explode('/', $rangoFecha);
                if (count($aux)== 1){
                    $q->whereDate('created_at', '=', $aux);
                }else{
                    $q->whereBetween('created_at', $aux);
                }
            })
            ->when($category, function ($q) use($category){
                $q->whereHas('warning_sub_category.warning_category', function (Builder $query) use($category){
                    $query->where('id', $category);
                });
            })
            ->when($subCategory, function ($q)use($subCategory){
                $q->where('warning_sub_category_id', $subCategory);
            })
            ->when($estado, function ($q)use($estado){
                $q->where('warning_state_id', $estado);
            })
            ->GetIntance()
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    public function getAllAnswerOfWarning($warningID){
        return WarningAnswer::where('warning_id', $warningID)->get();
    }

    public function getAllWarningCategory(){
        return WarningCategory::withoutGlobalScopes()
            ->withCount('sub_categories')
            ->GetIntance()
            ->get();
    }

    public function getAllWarningState(){
        return WarningState::withCount('warnings')->get();
    }

    /**
     *  P O S T
     **/

    public function getPosts($search=null, $rangoFecha=null, $sort=null, $perPage=15){
            return Post::when($search, function ($q) use($search){
                $q->where('titulo','like', '%'.$search.'%')
                    ->orWhere('subtitulo','like', '%'.$search.'%');
                })
                ->when($rangoFecha, function ($q) use($rangoFecha){
                    $aux = explode('-', $rangoFecha);
                    $q->whereBetween('fecha_inicio', $aux);
                })
                ->ApplySorts($sort)
                ->Active()
                ->PublishUpDate()
                ->paginate($perPage)->appends(request()->query());
    }

    public function getPost($post){
        return Post::findOrFail($post);
    }

    /**
     * NEGOCIOS
    **/
    public function getAllBusiness($search = null, $category = null, $sort= null, $perPage = 15){
        return Busine::with('category_busine')
            ->when($search, function ($q) use($search){
                $q->where('name','like','%'.$search.'%')
                    ->orWhere('direccion','like','%'.$search.'%')
                    ->orWhere('telefono','like','%'.$search.'%')
                    ->orWhere('email','like','%'.$search.'%')
                    ->orWhere('description','like','%'.$search.'%')
                    ->orWhere('url_web','like','%'.$search.'%');
            })
            ->when($category, function ($q) use($category){
                $q->where('category_busine_id', $category);
            })
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    public function getAllBusinessCategory(){
        return CategoryBusine::all();
    }

    /**
     * NOTIFICACIONES
    **/

    public function getAllNotifications($search = null,  $category = null, $sort=null, $perPage=15) {
       return Notification::with('category_notification')
            ->when($search, function ($q) use($search){
                $q->where('titulo','like','%'.$search.'%');
             })
            ->when($category, function ($q) use($category){
                $q->where('category_notification_id', $category);
            })
            ->PublishUpDate()
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    public function getAllNotificationsCategory(){
        return CategoryNotification::all();
    }

    /**
     * TELÉFONOS DE INTERES
    **/
    public function getAllPhones($search = null, $sort = null, $perPage = 15){
        return InterestPhone::when($search, function ($q) use($search){
            $q->where('name','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%')
                ->orWhere('phone','like','%'.$search.'%');
            })
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    /**
     * LOCALIZACIONES
    **/
    public function getLocations($search = null, $category = null, $sort = null, $perPage = 15){
        return Location::with('location_category')->withCount('location_category')
            ->when($search, function ($q) use($search){
            $q->where('name','like','%'.$search.'%')
                ->orWhere('ubicacion','like','%'.$search.'%')
                ->orWhere('telefono','like','%'.$search.'%');
            })
            ->when($category, function ($q) use($category){
                $q->where('location_category_id',$category);
            })
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    public function getAllCategoryLocation(){
        return LocationCategory::all();
    }

    /**
     * W I D G E T S
     **/
    public function getAllWidgets($search=null, $sort, $perPage=15){
        return Widget::when($search, function ($q) use($search){
            $q->where('titulo','like', '%'.$search.'%')
                ->orWhere('subtitulo','like', '%'.$search.'%');
              })
            ->Active()
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

}
