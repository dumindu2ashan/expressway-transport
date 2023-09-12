<?php

namespace Modules\Users\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->type == User::USER_TYPE_USER || Auth::user()->type == User::USER_TYPE_MANAGER || Auth::user()->type == User::USER_TYPE_IT_ADMIN || Auth::user()->type == User::USER_TYPE_OWNER)) {
            return $next($request);
        }
        abort(403);
    }
}
