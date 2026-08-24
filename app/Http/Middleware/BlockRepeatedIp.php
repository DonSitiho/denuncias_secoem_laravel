<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BlockRepeatedIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $blockKey = "ip_bloqueada:{$ip}";
        $attemptsKey = "intentos_ip:{$ip}";

        // Verificar si esta bloqueada la IP
        if (Cache::has($blockKey)) 
        {
            abort(403, 'Acceso denegado temporalmente. Intenta nuevamente más tarde.');
        }

        $intentos = Cache::get($attemptsKey , 0);

        if ($intentos >= 5) 
        {
            // Bloquear la IP
            Cache::put($blockKey, true, now()->addMinutes(60));
            Cache::forget($attemptsKey);

            abort(403, 'No puedes continuar en este momento. Intenta nuevamente más tarde.');
        }
        
        Cache::put($attemptsKey, $intentos + 1, now()->addMinutes(15));


        return $next($request);
    }
}
