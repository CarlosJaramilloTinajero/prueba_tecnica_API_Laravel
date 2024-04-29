<?php

namespace App\Http\Middleware;

use App\Helpers\HelpersResponseApi;
use App\Models\Commune;
use App\Models\Region;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateRequestCreateCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Validamos el request
        $validator = Validator::make($request->all(), [
            'id_reg' => 'required|numeric|exists:regions,id_reg',
            'id_com' => 'required|numeric|exists:communes,id_com',
            'email' => 'required|email',
            'name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'address' => 'required|min:5',
            // 'status' => 'required|in:A,I,trash',
            'dni' => 'required|min_digits:8|unique:customers,dni'
        ]);

        // Si hay errores en la validacion, retornamos con los errores y con el codigo 422
        if ($validator->fails()) {
            return HelpersResponseApi::responseFailApiWithMessage($validator->errors(), 422);
        }

        // Validamos que la region y el commune esten relacionados y activos
        $region = Region::where('id_reg', '=',$request->id_reg)->first();

        if (!$region || $region->status !== 'A') {
            return HelpersResponseApi::responseFailApiWithMessage('La region no existe o no esta activa', 422);
        }

        $commune = Commune::where('id_com', '=',$request->id_com)->first();

        if (!$commune || $commune->status !== 'A') {
            return HelpersResponseApi::responseFailApiWithMessage('El commune no existe o no esta activo', 422);
        }

        // Validamos que la region y el commune esten relacionados
        if ($commune->id_reg !== $region->id_reg) {
            return HelpersResponseApi::responseFailApiWithMessage('El commune debe de estar relacionado con la region', 422);
        }

        return $next($request);
    }
}
