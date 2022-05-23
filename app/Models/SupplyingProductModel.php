<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyingProductModel extends Model
{
    protected $table = 'supplying_product_tb';

    public $timestamps = false;

    protected $fillable = [
        'supplying', 'product', 'qtd', 'price', 'dolar', 'date_delivery', 'eliminado'
    ];
}
