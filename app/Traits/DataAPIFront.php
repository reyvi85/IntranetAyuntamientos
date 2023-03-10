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
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\InterestPhone;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Route;
use App\Models\RouteCategory;
use App\Models\Warning;
use App\Models\WarningAnswer;
use App\Models\WarningCategory;
use App\Models\WarningState;
use App\Models\WarningSubCategory;
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
            ->GetInstance()
            ->ForUser()
            ->ApplySorts($sort)
            ->get(); //paginate($perPage)->appends(request()->query());
    }

    public function getShowWarning($warning){
        return Warning::withoutGlobalScopes()
            ->with(['warning_state', 'warning_answers','warning_sub_category', 'warning_sub_category.warning_category'])
            ->withCount('warning_answers')
            ->GetInstance()
            ->findOrFail($warning);
    }

    public function getAllAnswerOfWarning($warningID){
        return WarningAnswer::withoutGlobalScopes()
            ->with(['warning'=>function($q){
                $q->GetInstance();
            }])
            ->where('warning_id', $warningID)
            ->get();
    }

    public function getShowAnswersOfWarning($answer){
        return WarningAnswer::GetInstance('warning.instance')
            ->find($answer);

    }

    public function getAllWarningCategory(){
        return WarningCategory::withoutGlobalScopes()
            ->withCount('sub_categories')
            ->GetInstance()
            ->get();
    }

    public function getWarningCategory($category){
        return WarningCategory::withoutGlobalScopes()
            ->withCount('sub_categories')
            ->GetInstance()
            ->findOrFail($category);
    }

    public function getWarningSubCategories($category)
    {
        return WarningCategory::withoutGlobalScopes()
            ->with('sub_categories')
            ->withCount('sub_categories')
            ->GetInstance()
            ->findOrFail($category);
    }

    public function getWarningSubCategoriesSinClasificar()
    {
        return WarningSubCategory::withoutGlobalScopes()
            ->where('name', 'like', '%Sin clasificar%')
            ->GetInstance('warning_category.instance')
            ->first();
    }

    public function getShowSubCategoryWarning($subcategory){
        return WarningSubCategory::withoutGlobalScopes()
                ->GetInstance('warning_category.instance')
                ->findOrFail($subcategory);
    }

    public function getAllSubCategoryWarning(){
        return WarningSubCategory::withoutGlobalScopes()
            ->GetInstance('warning_category.instance')
            ->get();
    }

    public function getAllWarningState(){
        return WarningState::withCount(['warnings'=>function ($q){
            $q->GetInstance();
        }])->get();
    }

    public function getShowWarningState($state){
        return WarningState::withCount(['warnings'=>function ($q){
            $q->GetInstance();
        }])->findOrFail($state);
    }

    /**
     *  P O S T
     **/

    public function getPosts($search=null, $rangoFecha=null, $sort=null, $perPage=15, $only=null){
            return Post::withoutGlobalScopes()
                ->when($search, function ($q) use($search){
                $q->where('titulo','like', '%'.$search.'%')
                    ->orWhere('subtitulo','like', '%'.$search.'%');
                })
                ->when($rangoFecha, function ($q) use($rangoFecha){
                    $aux = explode('-', $rangoFecha);
                    $q->whereBetween('fecha_inicio', $aux);
                })
                ->GetInstance()
                ->ApplySorts($sort)
                ->Active()
                ->ForView($only)
             //   ->PublishUpDate()
                ->paginate($perPage)->appends(request()->query());
    }

    public function getPost($post){
        return Post::withoutGlobalScopes()
            ->GetInstance()
            ->findOrFail($post);
    }

    /**
     * NEGOCIOS
    **/
    public function getAllBusiness($search = null, $category = null, $sort= null, $perPage = 15){
        return Busine::withoutGlobalScopes()
            ->with('category_busine')
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
            ->GetInstance()
            ->ApplySorts($sort)
            ->get();
    }

    public function getAllBusinessCategory(){
        return CategoryBusine::withCount(['business'=>function($q){
            $q->GetInstance();
             }])
            ->orderBy('business_count', 'desc')
            ->get();
    }

    public function getBusinessCategory($id){
        return CategoryBusine::withCount(['business'=>function($q){
            $q->GetInstance();
        }])
            ->findOrFail($id);
    }

    /**
     * NOTIFICACIONES
    **/

    public function getAllNotifications($search = null,  $category = null, $sort=null, $perPage=15) {
       return Notification::withoutGlobalScopes()
            ->with('category_notification')
            ->when($search, function ($q) use($search){
                $q->where('titulo','like','%'.$search.'%');
             })
            ->when($category, function ($q) use($category){
                $q->where('category_notification_id', $category);
            })
            ->PublishUpDate()
            ->GetInstance()
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    public function getAllNotificationsCategory(){
        return CategoryNotification::withoutGlobalScopes()
            ->withCount('notifications')
            ->GetInstance()
        ->get();
    }

    public function getCategory($id){
        return CategoryNotification::withoutGlobalScopes()
            ->withCount('notifications')
            ->GetInstance()
            ->findOrFail($id);
    }

    /**
     * TELÉFONOS DE INTERES
    **/
    public function getAllPhones($search = null, $sort = null, $perPage = 15){
        return InterestPhone::withoutGlobalScopes()
            ->when($search, function ($q) use($search){
            $q->where('name','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%')
                ->orWhere('phone','like','%'.$search.'%');
            })
            ->GetInstance()
            ->ApplySorts($sort)
            ->get();
    }

    public function getPhone($phone){
        return InterestPhone::withoutGlobalScopes()
            ->GetInstance()
            ->findOrFail($phone);
    }

    /**
     * LOCALIZACIONES
    **/
    public function getLocations($search = null, $category = null, $sort = null, $perPage = 15, $only=null){
        return Location::withoutGlobalScopes()
            ->with('location_category')->withCount('location_category')
            ->when($search, function ($q) use($search){
            $q->where('name','like','%'.$search.'%')
                ->orWhere('ubicacion','like','%'.$search.'%')
                ->orWhere('telefono','like','%'.$search.'%');
            })
            ->when($category, function ($q) use($category){
                $q->where('location_category_id',$category);
            })
            ->GetInstance()
            ->ForView($only)
            ->ApplySorts($sort)
            ->get();
    }

    public function getShowLocation($location){
        return Location::withoutGlobalScopes()
            ->GetInstance()
            ->findOrFail($location);
    }

    public function getAllCategoryLocation(){
        return LocationCategory::withoutGlobalScopes()
                ->withCount(['locations'=>function($q){
                    $q->GetInstance();
                 }])
            ->whereHas('locations', function (Builder $query){
                $query->GetInstance();
            })
            ->orderBy('locations_count', 'desc')
            ->get();

    }

    public function getShowCategoryLocation($category){
        return LocationCategory::withoutGlobalScopes()
            ->withCount('locations')
            ->GetInstance()
            ->findOrFail($category);
    }

    /**
     * W I D G E T S
     **/
    public function getAllWidgets($search=null, $sort, $perPage=15){
        return Widget::withoutGlobalScopes()
        ->when($search, function ($q) use($search){
            $q->where('titulo','like', '%'.$search.'%')
                ->orWhere('subtitulo','like', '%'.$search.'%');
              })
            ->GetInstance()
            ->Active()
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    /**
     *  E V E N T S
    */
    public function getAllEvents($search=null, $categoria=null){
        return Event::withoutGlobalScopes()->with('event_category')
            ->when($search, function ($q) use($search){
                $q->where('titulo','like', '%'.$search.'%')
                    ->orWhere('f_inicio','like', '%'.$search.'%')
                    ->orWhere('f_fin','like', '%'.$search.'%');
            })
            ->when($categoria, function ($q)use($categoria){
                $q->where('event_category_id',$categoria);
            })
            ->GetInstance()
            ->get();
    }

    public function getAllCategoryEvents(){
        return EventCategory::whereHas('events', function (Builder $q){
            $q->GetInstance();
        })
        ->withCount(['events'=>function ($q){
            $q->GetInstance();
        }])->get();
    }

    /**
     * Rutas
    **/

    public function getAllRoutesCategory(){
        return RouteCategory::withoutGlobalScopes()
            ->withCount('routes')
            ->has('routes')
            ->orderBy('routes_count','Desc')
            ->orderBy('name','Asc')
            ->get();
    }

    public function getAllRoutes($search = null, $categoria = null, $sort='id', $direction='desc'){
        return Route::with('route_category', 'route_intermediates')
            ->when($search, function ($q) use($search){
                $q->where('name','like', '%'.$search.'%')
                    ->orWhere('description','like', '%'.$search.'%');
            })
            ->when($categoria, function ($q) use($categoria){
                $q->where('route_category_id', $categoria);
            })
            ->GetInstance()
            ->orderBy($sort, $direction)
            ->get();
    }
}
