<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectUpb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'upb') {
            $kodeUpb = $user->KODE_UPB; // Sesuaikan dengan nama atribut KODE_UPB di model User
            return redirect()->route('home-upb', ['KODE_UPB' => $kodeUpb]);
        }

        return $next($request);
    }
}
