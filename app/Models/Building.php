<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'apartment_id');
    }
}
