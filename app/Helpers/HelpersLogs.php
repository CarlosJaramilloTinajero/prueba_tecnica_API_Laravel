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
        // Si la el APP_ENV es local, no utilice el APP_DEBUG por que no me deja utilizarlo
        if (env('APP_ENV') == 'local') {
            Log::log($level, 'Log de salida || ' . $msg);
        }
    }
}
