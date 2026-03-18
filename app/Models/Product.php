<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'stock_quantity', 'alert_threshold', 'price'];

    public function movements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
