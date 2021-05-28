<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product_tb';

    public $timestamps = false;

    protected $fillable = [
        'name', 'categorie', 'subcategorie', 'brand', 'new_price', 'old_price', 'dolar', 'discount', 'qtd_init', 'qtd', 'description', 'image',
        'status', 'eliminado', 'created_at'
    ];

}
