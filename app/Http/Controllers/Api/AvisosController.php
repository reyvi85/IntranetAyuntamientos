<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarningStoreRequest;
use App\Http\Resources\Warning\WarningAnswersResource;
use App\Http\Resources\Warning\WarningAnswersResourceCollection;
use App\Http\Resources\Warning\WarningCategoryResource;
use App\Http\Resources\Warning\WarningCategoryResourceCollection;
use App\Http\Resources\Warning\WarningResource;
use App\Http\Resources\Warning\WarningResourceCollection;
use App\Http\Resources\Warning\WarningStateResource;
use App\Http\Resources\Warning\WarningStateResourceCollection;
use App\Http\Resources\Warning\WarningSubCategoryResource;
use App\Http\Resources\Warning\WarningSubCategoryResourceCollection;
use App\Models\Warning;
use App\Models\WarningAnswer;
use App\Models\WarningCategory;
use App\Models\WarningState;
use App\Models\WarningSubCategory;
use App\Traits\DataAPIFront;
use Illuminate\Http\Request;

class AvisosController extends Controller
{
    use DataAPIFront;
    /** LISTA DE AVISOS **/
    public function index(Request $request){
        return WarningResourceCollection::make($this->getWarnings($request->search, $request->fecha, $request->category, $request->sub_category,$request->state,$request->sort ,$request->perPage));
    }
    /** MOSTRAR AVISO **/
    public function show(Request $request){
        $warning = $this->getShowWarning($request->warning);
        return WarningResource::make($warning);
    }
    /** CREAR AVISO **/
    public function warningStore(WarningStoreRequest $request){
        if ($request->has('image')){
            $path = $request->image->store('images/avisos', 'public');
        }else{
            $path=null;
        }
        $store = Warning::create([
            'asunto'=>$request->asunto,
            'description'=>$request->description,
            'ubicacion'=>$request->ubicacion,
            'image'=>$path,
            'lat'=>$request->latitud,
            'lng'=>$request->longitud,
            'instance_id'=>$request->instance,
            'warning_state_id'=>1,
            'warning_sub_category_id'=>$request->sub_categoria,
            'user_id'=>auth()->id()
        ]);
        if ($store){
            return response()->json(['message'=>'Se creó el aviso con éxito!'], 200);
        }
    }

    /** LISTA DE RESPUESTAS DE UN AVISO **/
    public function answerIndex(Request $request){
        return WarningAnswersResourceCollection::make(WarningAnswersResource::make($this->getAllAnswerOfWarning($request->id)));
    }

    /** VER RESPUESTAS **/
    public function answerShow(Request $request){
        $warningAnswer = $this->getShowAnswersOfWarning($request->warningAnswer);
        return WarningAnswersResource::make($warningAnswer);
    }
    /** Lista de CATEGORÍAS **/
    public function categoryIndex(Request $request){
        return WarningCategoryResourceCollection::make($this->getAllWarningCategory());
    }
    /** Ver categoría **/
    public function categoryShow(Request $request){
        $warningCategory = $this->getWarningCategory($request->warningCategory);
        return WarningCategoryResource::make($warningCategory);
    }

    /** LISTA SUB - CATEGORÍAS **/
    public function subCategoryIndex(WarningCategory $warningCategory){
        return WarningSubCategoryResourceCollection::make($warningCategory->sub_categories);
    }
    /** VER SUB - CATEGORÍAS **/
    public function subCategoryShow(WarningSubCategory $warningSubCategory){
        return WarningSubCategoryResource::make($warningSubCategory);
    }

    /** ESTADO DE LOS AVISOS **/
    public function stateIndex(){
       //$a = $this->getAllWarningState();

        return WarningStateResourceCollection::make($this->getAllWarningState());
    }
    /** VER ESTADO**/
    public function stateShow(WarningState $warningState){
        return WarningStateResource::make($warningState);
    }
}
