<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $role)
    {
        if(!in_array(Auth::user()->rol, array_values($role))){
            if (request()->wantsJson()){
                return response()->json(['message'=>'No tienen acceso a esta zona!'],403);
            }

            abort(403);
        }
        return $next($request);


    }
}
