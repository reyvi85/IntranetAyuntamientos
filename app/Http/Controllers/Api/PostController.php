<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Models\Post;
use App\Traits\DataModels;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use DataModels;
    public function index(Request $request){

        return PostResourceCollection::make($this->getNoticias($request->search, null, null, 'id', 'desc', $request->perPage));
    }

    public function show(Request $request){
        $q = Post::findOrFail($request->id);
        return PostResource::make($q);
    }
}
