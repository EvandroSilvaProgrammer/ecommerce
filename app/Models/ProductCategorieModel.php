<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategorieModel extends Model
{
    protected $table = 'product_categorie_tb';

    public $timestamps = false;

    protected $fillable = [
        'id', 'description'
    ];
}
