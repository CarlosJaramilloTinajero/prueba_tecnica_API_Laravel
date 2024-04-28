<?php

namespace App\Helpers;

// Clase con metodos estaticos para las respuestas de la API
class HelpersResponseApi
{
    static function responseWithServerInteralError(string $msg = '')
    {
        return response('Server internal error ' . $msg, 500);
    }

    static function responseFailApiWithMessage(string|array $msg = '', int $status = 200)
    {
        return response()->json(['succcess' => false, 'mgs' => $msg], $status);
    }

    static function responseSuccessApi($data = [])
    {
        return response()->json(array_merge(['succcess' => true], ['data' => $data]));
    }
}
