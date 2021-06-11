<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;
use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ProductModel $product)
    {
        $this->request = $request;
        $this->repository = $product;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $products = ProductModel::where('status', 'online')->orderBy('id', 'DESC')->paginate(21);

        $moreBought = DB::select(" SELECT count(product_tb.id) as 'qtd',  product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, request_product, product_brand_tb
        WHERE request_product.product_id = product_tb.id AND product_tb.brand = product_brand_tb.id
        AND ( request_product.status = 'PA' OR request_product.status = 'EN' )  GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");

        $brandsCategorie = DB::select(" SELECT DISTINCT product_brand_tb.* FROM product_brand_tb, product_tb, product_categorie_tb, product_subcategorie_tb
        WHERE product_tb.brand =  product_brand_tb.id
        AND product_tb.subcategorie = product_subcategorie_tb.id
        AND  product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_brand_tb.eliminado = 'no' ");

        // DEFAULT PRO MENU
            $brands = DB::select(" SELECT * FROM product_brand_tb ORDER BY name ");

            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ");

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

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id ");


        return view('site.products.showProducts',
        [
            'products' => $products,
            'moreBought' => $moreBought,
            'colors' => $colors,

            'brandsCategorie' => $brandsCategorie,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
           // 'services' => $services,
            'requests' => $requests,
            'contacts' => $contacts,
            'productsSession' => $productsSession,
        ]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $product = ProductModel::find($id);

        if (!$product || $product->eliminado == 'yes') {
            return redirect()->back();
        }

        $products = DB::select(" SELECT * FROM product_tb WHERE subcategorie = '$product->subcategorie'
        AND id <> '$product->id' AND status = 'Online' ORDER BY id DESC LIMIT 4; ");

        $categorie = DB::select(" SELECT product_categorie_tb.*
        FROM product_categorie_tb, product_tb, product_subcategorie_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_tb.id = {$id}
        AND product_categorie_tb.id = product_subcategorie_tb.categorie
        AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ");

        if ($products == [])
        {
            $cg = 1;
            if($categorie != [])
            {
                foreach ($categorie as $categ) {$cg = $categ->id;}
            }

            $products = DB::select(" SELECT product_tb.* FROM product_tb, product_categorie_tb, product_subcategorie_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_categorie_tb.id = '$cg'
            AND product_tb.id <> '$product->id'
            AND status = 'Online' ORDER BY id DESC LIMIT 4; ");
        }

        // DEFAULT PRO MENU
            $brands = DB::select(" SELECT * FROM product_brand_tb ORDER BY name ");

            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ");

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

        $extraImages = DB::select("SELECT extra_images_product_tb.image FROM extra_images_product_tb WHERE product={$id}");

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id
        AND product_tb.id = '$product->id' ");


        $details = DB::select(" SELECT product_detail_tb.* FROM product_detail_tb, product_tb
        WHERE product_detail_tb.product = product_tb.id
        AND product_tb.id = {$id} ");

        return view('site.products.showProduct',
        [
            'product' => $product,
            'products' => $products,
            'extraImages' => $extraImages,
            'brands' => $brands,
            //'services' => $services,
            'categories' => $categories,
            'categorie' => $categorie,
            'subcategories' => $subcategories,
            'colors' => $colors,
            'details' => $details,
            'requests' => $requests,
            'contacts' => $contacts,
            'productsSession' => $productsSession,
        ]);

    }

    public function personalizedQuery(Request $request)
    {
        $filters = $request->except('_token');

        if($request->categorie === null && $request->brand === null)
        {
            $products = ProductModel::where('status', 'online')
            ->whereBetween('new_price', array($request->price_min, $request->price_max))
            ->orderBy('brand')->paginate(20);
        }

        elseif ($request->categorie === null)
        {
            $products = ProductModel::where('status', 'online')->whereBetween('new_price', array($request->price_min, $request->price_max))
            ->whereIn(
                'brand', $request->brand
            )->orderBy('brand')->paginate(20);
        }

        elseif ($request->brand === null)
        {
            $products = ProductModel::where('status', 'online')->whereBetween('new_price', array($request->price_min, $request->price_max))
            ->whereIn(
                'categorie', $request->categorie
            )->orderBy('brand')->paginate(20);
        }

        elseif($request->categorie != null && $request->brand != null)
        {
            $products = ProductModel::where('status', 'online')->whereBetween('new_price', array($request->price_min, $request->price_max))
            ->whereIn(
                'categorie', $request->categorie
            )->whereIn(
                'brand', $request->brand
            )->orderBy('brand')->paginate(20);
        }

        $moreBought = DB::select(" SELECT count(product_tb.id) as 'qtd',  product_tb.id, product_tb.name, product_tb.image, product_brand_tb.name as 'brand',
        product_tb.new_price, product_tb.old_price, product_tb.discount
        FROM product_tb, request_product, product_brand_tb
        WHERE request_product.product_id = product_tb.id AND product_tb.brand = product_brand_tb.id
        AND ( request_product.status = 'PA' OR request_product.status = 'EN' ) GROUP BY product_tb.id, product_tb.name, product_tb.image, product_tb.categorie, product_brand_tb.name,
        product_tb.new_price, product_tb.old_price, product_tb.discount
        ORDER BY qtd DESC LIMIT 10 ");


        $brandsCategorie = DB::select(" SELECT DISTINCT product_brand_tb.* FROM product_brand_tb, product_tb, product_categorie_tb, product_subcategorie_tb
        WHERE product_tb.brand =  product_brand_tb.id
        AND product_tb.subcategorie = product_subcategorie_tb.id
        AND  product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_brand_tb.eliminado = 'no' ");

        // DEFAULT PRO MENU
            $brands = DB::select(" SELECT * FROM product_brand_tb ORDER BY name ");

            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ");

            $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ");

            $services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ORDER BY id DESC ");

            $requests = Pedido::where([
                'status' => 'RE',
                'client_id' => Auth::guard('client')->id()
            ])->get();

            $contacts = DB::select(" SELECT * FROM contacts_doriema ");
        //----

        $colors = DB::select(" SELECT color_tb.color as name, product_color_tb.qtd as qtd, product_color_tb.color as id, product_color_tb.product as product  FROM color_tb, product_color_tb, product_tb
        WHERE product_color_tb.color = color_tb.id AND product_color_tb.product = product_tb.id ");

        return view('site.products.showProducts',
        [
            'products' => $products,
            'moreBought' => $moreBought,
            'colors' => $colors,
            'brandsCategorie' => $brandsCategorie,

            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
           // 'services' => $services,
            'requests' => $requests,
            'filters' => $filters,
            'contacts' => $contacts,
        ]);

    }

}
