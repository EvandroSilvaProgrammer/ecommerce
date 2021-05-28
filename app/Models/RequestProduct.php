<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;


class RequestProduct extends Model
{
    protected $table = 'request_product';

    protected $fillable = [
        'request_id', 'product_id', 'status', 'value', 'color', 'qtd', 'time'
    ];


    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id' );
    }
}
