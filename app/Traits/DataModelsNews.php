<?php


namespace App\Traits;


use App\Models\Post;

trait DataModelsNews
{
    /**
     * N O T I C I A S
     **/

    public function getNoticias($search=null, $instancia = null, $rangoFecha=null, $sort='id', $direction='desc'){
        return Post::when($search, function ($q) use($search){
            $q->where('titulo','like', '%'.$search.'%')
                ->orWhere('subtitulo','like', '%'.$search.'%');
        })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->when($rangoFecha, function ($q) use($rangoFecha){
                $aux = explode('-', $rangoFecha);
                $q->whereBetween('fecha_inicio', $aux);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }
}
