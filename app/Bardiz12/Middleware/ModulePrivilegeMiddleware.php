<?php

namespace App\Bardiz12\Middleware;

use App\Modules\RolePrivilege\Models\RolePrivilege;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ModulePrivilegeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $name = Route::currentRouteName();
        $parts = explode(".",$name);
        $module = $parts[0];
        $action = $parts[count($parts) - 1];
        $mapper = [
            'index' => 'read',
            'show' => 'read',
            'store' => 'create',
            'edit' => "update",
            'destroy' => 'delete',
            'validate' => 'validate'
        ];
        $action = $mapper[$action] ?? $action;
        return allowAccess($module, $action)
                ? $next($request)
                : abort(403, "Anda tidak memiliki hak akses");
    }
}
