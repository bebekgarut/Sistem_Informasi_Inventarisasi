<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUPB
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'upb') {
                $userKodeUpb = Auth::user()->KODE_UPB;
                $requestKodeUpb = $request->route('KODE_UPB');

                if ($userKodeUpb == $requestKodeUpb) {
                    return $next($request);
                } else {
                    return redirect()->route('home-upb', ['KODE_UPB' => $userKodeUpb]);
                }
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
