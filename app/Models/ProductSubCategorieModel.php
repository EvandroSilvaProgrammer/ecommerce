<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategorieModel extends Model
{
    protected $table = 'product_subcategorie_tb';

    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'categorie'
    ];
}
