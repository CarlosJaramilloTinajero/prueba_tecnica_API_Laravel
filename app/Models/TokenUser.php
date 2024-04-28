<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokenUser extends Model
{
    use HasFactory;
    // Especificamos la tabla que utilizara este modelo en la base de datos
    protected $table = 'tokens_with_expiraions';

    // Campos que se pueden asignar en masa (mass assignment)
    protected $fillable = ['token', 'expired_at', 'expired', 'user_id'];

    // Definimos que el campo 'expired_at' debe ser tratado como una instancia de Carbon (fecha y hora)
    protected $dates = ['expired_at'];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Funcion para validar si el token ya esta expirado
    function isExpired(): bool
    {
        $expired = $this->expired_at->isPast();

        // Si ya esta expirado actualizamos la propiedad expired a true
        if ($expired) {
            $this->update(['expired' => true]);
        }

        return $expired;
    }
}
