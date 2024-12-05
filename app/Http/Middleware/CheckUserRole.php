<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if ($user && $user->role === 'mdd') {
            $request->attributes->add(['dashboard_url' => 'mdd']);
        } else {
            $request->attributes->add(['dashboard_url' => 'dashboard']);
        }
        
        return $next($request);
    }
}
