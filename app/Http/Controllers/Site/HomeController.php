<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;
use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Auth;
use App\Models\Promotion;

class HomeController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ProductModel $product)
    {
        $this->request = $request;
        $this->repository = $product;
    }

    public function showHome()
    {
        $products = ProductModel::where('status', 'online')
                                ->where('categorie', '1')
                                ->orWhere(function($query) {
                                    $query->where('categorie', '2')
                                          ->orWhere('categorie', '4');
                                })
                                ->orderBy('id', 'DESC')->get();
        /*
        $servicesAll = DB::select(" SELECT * FROM service_tb WHERE status = 'Online' ORDER BY id DESC ");
        */

        $slideProducts = ProductModel::where('slide', 'TRUE')->get();

        $moreBought = DB::select(" SELECT count(product_tb.id) as 'qtd',  product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, request_product, product_brand_tb
        WHERE request_product.product_id = product_tb.id AND product_tb.brand = product_brand_tb.id
        AND ( request_product.status = 'PA' OR request_product.status = 'EN' ) GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");

        $bestsDiscount = DB::select(" SELECT count(product_tb.id) as 'qtd', product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, product_brand_tb
        WHERE product_tb.brand = product_brand_tb.id
        AND product_tb.discount <> '' AND product_tb.discount > 0 GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");

        $promotion = Promotion::find(01);


        // DEFAULT PRO MENU
        $brands = DB::select(" SELECT * FROM product_brand_tb ");

        $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ASC ");

        $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ORDER BY product_subcategorie_tb.name ASC ");

        //$services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ");

        $requests = Pedido::where([
            'status' => 'RE',
            'client_id' => Auth::guard('client')->id()
        ])->get();

        $productsSession = [];
        if (Auth::guard('client')->check() === false)
        {
            $productsSession = session("cart");
        }


        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        //----

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id ");


        if($promotion != null)
        {
            return view('site.home', [
                'brands' => $brands,
                //'services' => $services,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'requests' => $requests,
                'contacts' => $contacts,

                'products' => $products,
                //'servicesAll' => $servicesAll,
                'colors' => $colors,
                'slideProducts' => $slideProducts,
                'moreBought' => $moreBought,
                'bestsDiscount' => $bestsDiscount,

                'promotion' => $promotion,

                'productsSession' => $productsSession,
            ]);
        }

        return view('site.home', [
            'brands' => $brands,
            //'services' => $services,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'requests' => $requests,

            'products' => $products,
            //'servicesAll' => $servicesAll,
            'colors' => $colors,
            'slideProducts' => $slideProducts,
            'moreBought' => $moreBought,
            'bestsDiscount' => $bestsDiscount,
            'contacts' => $contacts,

            'productsSession' => $productsSession,
        ]);
    }

}
