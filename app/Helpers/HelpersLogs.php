<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class HelpersLogs
{
    static function setlogIn($msg, $level)
    {
        Log::log($level, 'Log de entrada || ' . $msg);
    }

    static function setlogOut($msg, $level)
    {
        // Si la el APP_DEBUG, si el metodo env retorna nulo, se necesita configurar los permisos
        if (env('APP_DEBUG')) {
            Log::log($level, 'Log de salida || ' . $msg);
        }
    }
}
