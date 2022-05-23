<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrandModel extends Model
{
    protected $table = 'product_brand_tb';

    public $timestamps = false;

    protected $fillable = [
        'id', 'name'
    ];
}
