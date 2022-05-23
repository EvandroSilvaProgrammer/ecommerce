<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColorModel extends Model
{
    protected $table = 'product_color_tb';

    public $timestamps = false;

    protected $fillable = [
        'color', 'product', 'qtd'
    ];
}
