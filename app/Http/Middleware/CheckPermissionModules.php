<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\Helper;


class CheckPermissionModules
{
    use Helper;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

       // dd(Route::currentRouteName());
        $perm = $this->modulosApp()->whereIn('id', [1,2]);
        return $next($request);
    }
}
