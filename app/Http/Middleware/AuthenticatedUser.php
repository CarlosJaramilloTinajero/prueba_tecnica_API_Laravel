<?php

namespace App\Http\Middleware;

use App\Helpers\HelpersResponseApi;
use App\Models\TokenUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Validamos si no se esta obteniendo el encabezado Authorization y si existe un registro en el modelo TokenUser con el token obtenido
        if (
            !$request->hasHeader('Authorization') ||
            !$tokenUser = TokenUser::where('token', $request->header('Authorization'))->first()
        ) {
            return HelpersResponseApi::responseFailApiWithMessage('Unauthorized', 401);
        }

        // Validamos que el token no este expirado
        if ($tokenUser->expired || $tokenUser->isExpired()) {
            return HelpersResponseApi::responseFailApiWithMessage('El token ya expiro', 401);
        }

        return $next($request);
    }
}
