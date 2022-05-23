<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyProductModel extends Model
{
    protected $table = 'supply_product_tb';

    public $timestamps = false;

    protected $fillable = [
        'supply', 'product', 'price', 'dolar', 'qtd'
    ];
}
