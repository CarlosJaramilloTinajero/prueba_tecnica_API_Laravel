<?php

namespace App\Helpers;

// Clase con metodos estaticos para las respuestas de la API
class HelpersResponseApi
{
    static function responseWithServerInteralError(string $msg = '')
    {
        HelpersLogs::setlogOut('Server internal error ' . $msg, 'error');
        return response('Server internal error ' . $msg, 500);
    }

    static function responseFailApiWithMessage(string|array $msg = '', int $status = 200)
    {
        HelpersLogs::setlogOut(json_encode(['succcess' => false, 'mgs' => $msg]), 'warning');
        return response()->json(['succcess' => false, 'mgs' => $msg], $status);
    }

    static function responseSuccessApi($data = [])
    {
        HelpersLogs::setlogOut(json_encode(array_merge(['succcess' => true], ['data' => $data])), 'info');
        return response()->json(array_merge(['succcess' => true], ['data' => $data]));
    }
}
