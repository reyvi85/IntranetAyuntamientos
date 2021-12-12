<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Models\Post;
use App\Traits\DataAPI;
use App\Traits\DataModels;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class PostController extends Controller
{
    use DataAPI;

    /**
     * @param Request $request
     * @param search Texto a buscar
     * @param fecha  Rango de fecha en el que se quiere localizar una lista de articulos Ej. 2021/12/01-2021/12/15
     * @param sort  Columnas de orden ['id','titulo', 'subtitulo','fecha_inicio'], cada valor separado por comas y un signo - delante es Descendente
     * @param perPage Cantidad de registros por Página
     * @return PostResourceCollection
     */
    public function index(Request $request){
      return PostResourceCollection::make($this->getPosts($request->search, $request->fecha, $request->sort, $request->perPage));

    }

    /**
     * @param Request $request
     * @return PostResource
     */
    public function show(Request $request){
        return PostResource::make($this->getPost($request->id));
    }
}
