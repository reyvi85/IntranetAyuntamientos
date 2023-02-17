<?php


namespace App\Traits;


use App\Models\Community;
use App\Models\Province;
use Illuminate\Database\Eloquent\Builder;

trait DataModelsComunityProvinces
{
    /** Lista de comunidades filtradas
     * @param null $search
     * @param $sort
     * @param $direction
     * @return array|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Traits\Conditionable[]
     */
    public function getComunidades($search = null, $sort='id', $direction='desc'){
        return Community::with('provincias')
            ->when($search, function ($q) use ($search){
                $q->where('name', 'like', '%'.$search.'%');
            })
            ->orderBy($sort, $direction)
            ->get();
    }

    /** Lista de Comunidades
     * @return Community[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCommunity(){
        return Community::all();
    }

    /** Lista de provincias
     * @param $community
     * @return mixed
     */
    public function getProvince($community){
        return Province::where('community_id', $community)->get();
    }
}
