<?php

namespace App\Http\Middleware;

use App\Helpers\HelpersResponseApi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateRequestLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Si hay fails en la validacion, retornamos con los errores y con el codigo 422
        if ($validator->fails()) {
            return HelpersResponseApi::responseFailApiWithMessage($validator->errors(), 422);
        }

        return $next($request);
    }
}
