<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokenUser extends Model
{
    use HasFactory;
    protected $table = 'tokens_with_expiraions';
    protected $fillable = ['token', 'expired_at', 'expired', 'user_id'];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
