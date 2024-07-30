<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['item_name', 'item_quantity'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
