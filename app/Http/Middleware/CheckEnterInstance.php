<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\Helper;

class CheckEnterInstance
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
        $inst = $this->getCheckInstance($request->token_inst);

        if(!$request->has('token_inst') || is_null($inst)){
            abort(403);
        }

        return $next($request);
    }
}
