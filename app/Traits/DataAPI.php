<?php
/**
 * Created by PhpStorm.
 * User: reyvi
 * Date: 9/12/2021
 * Time: 15:19
 */

namespace App\Traits;


use App\Models\Post;
use App\Models\Warning;
use App\Models\WarningAnswer;
use App\Models\WarningCategory;
use App\Models\WarningState;
use Illuminate\Database\Eloquent\Builder;

trait DataAPI
{
    public function getWarnings($search=null, $rangoFecha=null, $category = null, $subCategory = null , $estado=null){
        return Warning::with(['warning_state', 'warning_answers','warning_sub_category', 'warning_sub_category.warning_category'])
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
                $aux = explode('-', $rangoFecha);
                $q->whereBetween('created_at', $aux);
            })

            ->when($category, function ($q) use($category){
                $q->whereHas('warning_sub_category.warning_category', function (Builder $query) use($category){
                    $query->where('id', $category);
                });
            })
            ->when($subCategory, function ($q)use($subCategory){
                $q->where('warning_sub_category_id', $subCategory);
            })
            ->paginate();
    }

    public function getAllAnswerOfWarning($warningID){
        return WarningAnswer::where('warning_id', $warningID)->get();
    }

    public function getWarningStates(){
        return WarningState::all();
    }

    public function getAllWarningCategory(){
        return WarningCategory::get();
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
                ->paginate($perPage)->appends(request()->query());
    }

    public function getPost($post){
        return Post::findOrFail($post);
    }

}
