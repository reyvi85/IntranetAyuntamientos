<?php


namespace App\Traits;


use App\Models\Warning;
use App\Models\WarningCategory;
use App\Models\WarningState;
use App\Models\WarningSubCategory;
use Illuminate\Database\Eloquent\Builder;

trait DataModelsAvisos
{
    /**
     * Avisos
     */

    public function getAllWarningsCategory($search = null,  $instancia=null, $sort='id', $direction='desc'){
        return WarningCategory::with('sub_categories')->withCount('sub_categories')
            ->when($search, function ($q) use($search){
                $q->where('name','like','%'.$search.'%');
            })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getWarningsCategoryFiltered($instancia = null){
        return WarningCategory::when($instancia, function ($q) use($instancia){
            $q->where('instance_id',$instancia);
        })
            ->get();
    }

    public function getWarningSubCategoryFiltered($category=null){
        return WarningSubCategory::when($category, function ($q) use($category){
            $q->where('warning_category_id',$category);
        })
            ->get();
    }

    public function getAllState($instancia = null){
        return WarningState::with(['warnings'=>function($q) use($instancia){
            $q->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            });
            }])
            ->get();
    }

    public function getAllWarnings($search=null, $instancia = null, $rangoFecha=null, $category = null, $subCategory = null , $estado=null, $sort='id', $direction='desc'){
        return Warning::with(['warning_state', 'warning_answers','warning_sub_category', 'warning_sub_category.warning_category'])
            ->withCount('warning_answers')
            ->when($search, function ($q) use($search){
                $q->where('asunto','like', '%'.$search.'%')
                    ->orWhere('description','like', '%'.$search.'%')
                    ->orWhere('ubicacion','like', '%'.$search.'%');
            })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
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
            ->orderBy($sort, $direction)
            ->paginate();
    }
}
