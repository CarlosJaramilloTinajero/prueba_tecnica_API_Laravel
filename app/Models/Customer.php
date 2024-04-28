<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['id_reg', 'id_com', 'email', 'name', 'last_name', 'address', 'date_reg', 'status', 'dni'];

    function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'id_reg', 'id_reg');
    }

    function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class, 'id_com', 'id_com');
    }
}
