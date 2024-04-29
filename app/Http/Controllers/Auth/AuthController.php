<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\HelpersLogs;
use App\Helpers\HelpersResponseApi;
use App\Http\Controllers\Controller;
use App\Models\TokenUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function login(Request $request)
    {
        try {
            HelpersLogs::setlogIn('IP: ' . $request->ip() . '|| Login request: ' .  json_encode($request->all()), 'info');

            // Verificamos que exista el usuario
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return HelpersResponseApi::responseFailApiWithMessage('Unathorize', 401);
            }

            // Obtenemos el modelo del usuario
            if (!$user = User::where('email', $request->email)->first()) {
                return HelpersResponseApi::responseFailApiWithMessage('Error al obtener al usuario');
            }

            // Fecha actual
            $dateLogin = now();

            // Creacion de token
            $token = sha1($user->email . $dateLogin . mt_rand(200, 500));

            // Creacion del modelo TokenUser para guardar el token del usuario, agregando un dia como expiracion del token
            $tokenUser = TokenUser::create([
                'token' => $token,
                'expired_at' => $dateLogin->addDays(1),
                'user_id' => $user->id
            ]);

            // Si no se creo el token
            if (!$tokenUser) return HelpersResponseApi::responseFailApiWithMessage('Error al generar el token');

            // Respondemos con el token creado y la fecha de expiracion
            return HelpersResponseApi::responseSuccessApi([
                'token' => $token,
                'expired_at' => $tokenUser->expired_at->format('d/m/Y H:i')
            ]);
        } catch (\Exception $e) {
            report($e);
            return HelpersResponseApi::responseWithServerInteralError();
        }
    }
}
