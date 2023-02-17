<?php


namespace App\Traits;


use App\Models\Widget;

trait DataModelsWidgets
{
    /**
     * W I D G E T S
     **/
    public function getAllWidgets($search=null, $instancia = null, $sort='id', $direction='desc'){
        return Widget::when($search, function ($q) use($search){
            $q->where('titulo','like', '%'.$search.'%')
                ->orWhere('subtitulo','like', '%'.$search.'%');
        })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }
}
