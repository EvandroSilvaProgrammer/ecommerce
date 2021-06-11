<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\Request as Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductModel::where('discount', '<>', 0)->paginate(20);

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id ");

        $brands = DB::select(" SELECT * FROM product_brand_tb ORDER BY name ");

        $moreBought = DB::select(" SELECT count(product_tb.id) as 'qtd',  product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, request_product, product_brand_tb
        WHERE request_product.product_id = product_tb.id AND product_tb.brand = product_brand_tb.id
        AND ( request_product.status = 'PA' OR request_product.status = 'EN' ) AND product_tb.discount <> 0  GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");



        // DEFAULT PRO MENU
        $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no'  ");

        $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ");

        //$services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ");

        $requests = Pedido::where([
            'status' => 'RE',
            'client_id' => Auth::guard('client')->id()
        ])->get();

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        $productsSession = [];
        if (Auth::guard('client')->check() === false)
        {
            $productsSession = session("cart");
        }
        //----

        return view('site.promotions.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            //'services' => $services,
            'requests' => $requests,
            'productsSession' => $productsSession,
            'contacts' => $contacts,

            'products' => $products,
            'brands' => $brands,
            'colors' => $colors,
            'moreBought' => $moreBought,
        ]);
    }

}
