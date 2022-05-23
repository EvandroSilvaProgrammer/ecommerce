<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\RequestProduct;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class Request extends Model
{
    protected $table = 'request';

    protected $fillable = [
        'client_id', 'status', 'time'
    ];

    public function RequestProduct()
    {
        return $this->hasMany(RequestProduct::class)
        ->select( DB::raw("id, product_id, sum(discount) as 'discounts', sum(value) as 'values', qtd, color, status ") )
        ->groupBy('id', 'product_id', 'color', 'qtd', 'status')
        ->orderBy('id', 'DESC');
    }

    public function requestProductItem()
    {
        return $this->hasMany(RequestProduct::class);
    }

    public static function queryID($where)
    {
        $request = self::where($where)->first(['id']);

        if(!empty($request->id))
        {
            return $request->id;
        }

        return null;
    }
}
