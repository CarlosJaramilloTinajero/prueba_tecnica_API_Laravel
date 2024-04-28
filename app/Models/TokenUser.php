<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenUser extends Model
{
    use HasFactory;
    protected $table = 'tokens_with_expiraions';
    protected $fillable = ['token', 'expired_at', 'expired'];
}
