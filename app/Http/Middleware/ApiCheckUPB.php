<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiCheckUPB
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userKodeUpb = Auth::user()->KODE_UPB;
        $requestKodeUpb = $request->route('kode_upb');
        if (Auth::check()) {
            if (Auth::user()->role == 'upb') {
                if ($userKodeUpb == $requestKodeUpb) {
                    return $next($request);
                } else {
                    return response()->json(['message' => 'anda tidak memilki akses']);
                }
            } else {
                return response()->json(['message' => 'anda tidak memilki akses2']);
            }
        }
    }
}
