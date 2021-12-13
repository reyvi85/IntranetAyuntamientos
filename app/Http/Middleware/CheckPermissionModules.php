<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\Helper;
use Illuminate\Support\Facades\Auth;


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
       if(Auth::user()->rol !='Super-Administrador'){
            if (!$this->getCheckAccessModules()){
                    abort(403,'No tiene Acceso al módulo: '.$this->getModuleNameAccess());
            }
        }
        return $next($request);
    }
}
