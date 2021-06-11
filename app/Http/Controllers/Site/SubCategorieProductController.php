<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;
use App\Models\ProductSubCategorieModel;
use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Auth;

class SubCategorieProductController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ProductModel $product)
    {
        $this->request = $request;
        $this->repository = $product;
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $subcategorie = ProductSubCategorieModel::find($id);

        if(!$subcategorie || $subcategorie->eliminado == 'yes')
        {
            return redirect()->back();
        }

        $products = ProductModel::where('status', '=', 'Online')->where('subcategorie', '=', $id)->orderBy('id', 'DESC')->paginate(20);

        $moreBought = DB::select(" SELECT count(product_tb.id) as 'qtd',  product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, request_product, product_brand_tb
        WHERE request_product.product_id = product_tb.id AND product_tb.brand = product_brand_tb.id
        AND product_tb.subcategorie = {$id}
        AND request_product.status = 'PA' GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");

        // DEFAULT PRO MENU
            $brands = DB::select(" SELECT * FROM product_brand_tb ");

            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no'  ");

            $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ");

          // $services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ORDER BY id DESC ");

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

        $brandsSubCategorie = DB::select(" SELECT DISTINCT product_brand_tb.* FROM product_brand_tb, product_tb
        WHERE product_tb.brand = product_brand_tb.id
        AND product_tb.subcategorie = {$id}
        AND product_tb.status = 'online' AND product_brand_tb.eliminado = 'no' ");

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id ");

        return view('site.products.subCategorie',
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            //'services' => $services,
            'brands' => $brands,
            'requests' => $requests,
            'moreBought' => $moreBought,
            'productsSession' => $productsSession,


            'products' => $products,
            'subcategorie' => $subcategorie,
            'brandsSubCategorie' => $brandsSubCategorie,
            'colors' => $colors,
            'contacts' => $contacts,
        ]);
    }

    public function personalizedQuerysubcategorie(Request $request)
    {
        $filters = $request->except('_token');

        if ($request->brand === null)
        {
            $products = ProductModel::where('status', 'online')->where('subcategorie', $request->subcategorie)
            ->whereBetween('new_price', array($request->price_min, $request->price_max))
            ->orderBy('brand')->paginate(20);
        }

        elseif($request->brand != null)
        {
            $products = ProductModel::where('status', 'online')->where('subcategorie', $request->subcategorie)
            ->whereBetween('new_price', array($request->price_min, $request->price_max))
            ->whereIn(
                'brand', $request->brand
            )->orderBy('brand')->paginate(20);
        }

        $subcategorie = ProductSubCategorieModel::find($request->subcategorie);

        $moreBought = DB::select(" SELECT count(product_tb.id) as 'qtd',  product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, request_product, product_brand_tb
        WHERE request_product.product_id = product_tb.id AND product_tb.brand = product_brand_tb.id
        AND product_tb.subcategorie = '$request->subcategorie'
        AND request_product.status = 'PA' GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");

        // DEFAULT PRO MENU
            $brands = DB::select(" SELECT * FROM product_brand_tb ");

            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no'  ");

            $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ");

            //$services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ORDER BY id DESC ");

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

        $brandsSubCategorie = DB::select(" SELECT DISTINCT product_brand_tb.* FROM product_brand_tb, product_tb
        WHERE product_tb.brand = product_brand_tb.id
        AND product_tb.subcategorie = '$request->subcategorie'
        AND product_tb.status = 'online' AND product_brand_tb.eliminado = 'no' ");

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id ");

        return view('site.products.subCategorie',
        [
            'categories' => $categories,
            'subcategories' => $subcategories,
            //'services' => $services,
            'brands' => $brands,
            'requests' => $requests,
            'moreBought' => $moreBought,
            'productsSession' => $productsSession,

            'products' => $products,
            'subcategorie' => $subcategorie,
            'brandsSubCategorie' => $brandsSubCategorie,
            'colors' => $colors,
            'filters' => $filters,
            'contacts' => $contacts,
        ]);
    }

}
