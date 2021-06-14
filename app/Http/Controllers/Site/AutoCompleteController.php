<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;
use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Auth;



class AutoCompleteController extends Controller
{
    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');

            $data = DB::table('product_tb')
                    ->where('name', 'LIKE', "%$query%")
                    ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative"> ';

            foreach($data as $row)
            {
                $output .= '<li><a href="#">'.$row->name.'</a></li> ';
            }
            $output .= '</ul>';

            echo $output;
        }
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = DB::table('product_tb')->where('name', 'LIKE', "%$request->product%")->paginate(20);

        $moreBought = DB::select(" SELECT count(product_tb.id) as 'qtd',  product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, request_product, product_brand_tb
        WHERE request_product.product_id = product_tb.id AND product_tb.brand = product_brand_tb.id
        AND request_product.status = 'PA' GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");

        // DEFAULT PRO MENU
            $brands = DB::select(" SELECT * FROM product_brand_tb ORDER BY name ");

            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ASC ");

            $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ORDER BY product_subcategorie_tb.name ASC ");

            //$services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ORDER BY id DESC ");

            $requests = Pedido::where([
                'status' => 'RE',
                'client_id' => Auth::guard('client')->id()
            ])->get();

            $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        //----

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id ");


         $brandsCategorie = DB::select(" SELECT DISTINCT product_brand_tb.* FROM product_brand_tb, product_tb, product_categorie_tb, product_subcategorie_tb
        WHERE product_tb.brand =  product_brand_tb.id
        AND product_tb.subcategorie = product_subcategorie_tb.id
        AND  product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_brand_tb.eliminado = 'no' ");


        return view('site.products.showProducts',
        [
            'products' => $products,
            'moreBought' => $moreBought,
            'colors' => $colors,

            'brandsCategorie' => $brandsCategorie,

            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            //'services' => $services,
            'requests' => $requests,
            'filters' => $filters,
            'contacts' => $contacts,
        ]);

    }

    // /* AJAX Request */
    // public function Product(Request $request)
    // {
    //     // dd( $request->search);
    //     $search = $request->search;

    //     if($search == '')
    //     {
    //         $products = ProductModel::orderBy('name', 'ASC')->select('id', 'name')->limit(10)->get();

    //     }
    //     else
    //     {
    //         $products = ProductModel::orderBy('name', 'ASC')->selet('id', 'name')->where('name', 'LIKE', "%'$search'%")->limit(10)->get();
    //     }

    //     $response = array();

    //     foreach($products as $product)
    //     {
    //         $response[] = array("value"=>$product->id, "label"=>$product->name);
    //     }

    //     echo json_encode($response);
    //     exit;
    // }
}
