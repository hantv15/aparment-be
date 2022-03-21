<?php

namespace App\Http\Middleware;

use App\Extensions\RestfulResourceTrait;
use App\Models\User;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    use RestfulResourceTrait;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse|void
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = Auth::user()->role_id;
        if ($userId != User::ADMIN){
            return $this->failed("You can't access this page. Only admin can do that");
        }

        return $next($request);
    }
}
