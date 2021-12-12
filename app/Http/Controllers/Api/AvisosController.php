<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Warning\WarningAnswersResource;
use App\Http\Resources\Warning\WarningAnswersResourceCollection;
use App\Http\Resources\Warning\WarningCategoryResource;
use App\Http\Resources\Warning\WarningCategoryResourceCollection;
use App\Http\Resources\Warning\WarningResource;
use App\Http\Resources\Warning\WarningResourceCollection;
use App\Http\Resources\Warning\WarningSubCategoryResource;
use App\Http\Resources\Warning\WarningSubCategoryResourceCollection;
use App\Models\Warning;
use App\Models\WarningAnswer;
use App\Models\WarningCategory;
use App\Models\WarningSubCategory;
use App\Traits\DataAPI;
use Illuminate\Http\Request;

class AvisosController extends Controller
{
    use DataAPI;

    public function index(Request $request){
        return WarningResourceCollection::make($this->getWarnings(null, null, null, null,null));
    }

    public function show(Warning $warning){
        return WarningResource::make($warning);
    }

    /** LISTA DE RESPUESTAS DE UN AVISO **/
    public function answerIndex(Request $request){
        return WarningAnswersResourceCollection::make(WarningAnswersResource::make($this->getAllAnswerOfWarning($request->id)));
    }

    /** VER RESPUESTAS **/
    public function answerShow(WarningAnswer $warningAnswer){
        return WarningAnswersResource::make($warningAnswer);
    }
    /** CATEGORÍAS **/
    public function categoryIndex(Request $request){
        return WarningCategoryResourceCollection::make($this->getAllWarningCategory());
    }

    public function categoryShow(WarningCategory $warningCategory){
        return WarningCategoryResource::make($warningCategory);
    }

    /** SUB - CATEGORÍAS **/
    public function subCategoryIndex(WarningCategory $warningCategory){
        return WarningSubCategoryResourceCollection::make($warningCategory->sub_categories);
    }

    public function subCategoryShow(WarningSubCategory $warningSubCategory){
        return WarningSubCategoryResource::make($warningSubCategory);
    }



    /** ESTADO DE LOS AVISOS **/
    public function stateIndex(){

    }
}
