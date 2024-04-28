<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'status'];

    function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'id_reg', 'id_reg');
    }

    function communes(): HasMany
    {
        return $this->hasMany(Commune::class, 'id_reg', 'id_reg');
    }
}
