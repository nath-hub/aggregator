<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthIfNeeded
{
  
    
     protected array $publicRoutes = [
        'user-service/register',
        'user-service/login',
        'user-service/password/forgot',
    ];

    public function handle(Request $request, Closure $next)
    {
        $path = ltrim($request->path(), 'api/');

        if (!in_array($path, $this->publicRoutes)) {
            if (!$request->bearerToken() || !Auth::guard('api')->check()) {
                return response()->json(['message' => 'Non authentifié'], 401);
            }
        }

        return $next($request);
    }

}
