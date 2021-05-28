<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Http\Requests\StoreUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Admim\ExtraImagesController;

use Gate;

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
        if(Gate::denies('Visualizar Produtos') && Gate::denies('Cadastrar Produtos'))
        {
            return redirect()->back();
        }

        $products = ProductModel::all()->where('eliminado', 'no');
        $subcategories = DB::select(" SELECT * FROM product_subcategorie_tb ");
        //$brands = DB::select("SELECT * FROM product_brand_tb");

        $categories = DB::select(" SELECT * FROM product_categorie_tb ");

        return view('admim.products.createProducts', [
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
           // 'brands' => $brands
        ]);
    }

    public function getBrandsAdd(Request $request, $id)
    {
        if($request->ajax())
        {
            $brands = DB::select(" SELECT product_brand_tb.id as id , product_brand_tb.name as name
            FROM product_brand_tb, product_subcategorie_tb, brand_subcategorie_tb
            WHERE brand_subcategorie_tb.subcategorie = {$id}
            AND brand_subcategorie_tb.brand = product_brand_tb.id
            AND brand_subcategorie_tb.subcategorie = product_subcategorie_tb.id ");

            return response()->json($brands);
        }
    }

    public function getBrandsEdit(Request $request, $outro, $id)
    {
        if($request->ajax())
        {
            $brands = DB::select(" SELECT product_brand_tb.id as id , product_brand_tb.name as name
            FROM product_brand_tb, product_subcategorie_tb, brand_subcategorie_tb
            WHERE brand_subcategorie_tb.subcategorie = {$id}
            AND brand_subcategorie_tb.brand = product_brand_tb.id
            AND brand_subcategorie_tb.subcategorie = product_subcategorie_tb.id ");

            return response()->json($brands);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //ADICIONAR CATEGORIA A TABELA DE PRODUCTO
    {
        if(Gate::denies('Cadastrar Produtos'))
        {
            return redirect()->back();
        }

        $cambios = DB::select("SELECT * FROM exchange_tb");
        foreach ($cambios as $cambio) {
            $cambio->exchange;
        }

        $categories = DB::select(" SELECT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb
        WHERE product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_subcategorie_tb.id = '$request->subcategorie' ");
        foreach ($categories as $categorie) {
            $categorie->id;
        }

       $data = $request->all();

       if($request->hasFile('image') && $request->image->isValid())
       {
           //$imageName = $request->name . '_' . $request->id . '.' . $request->image->extension();
           $imagePath = $request->image->store('products/imgs');

           $data['image'] = $imagePath;
       }

       $data['qtd'] = $request->qtd;

       $data['qtd_init'] = $request->qtd;

       $data['categorie'] = $categorie->id;

       $data['new_price'] = $request->old_price - $request->old_price * ($request->discount / 100);

       $request->new_price = $request->old_price - $request->old_price * ($request->discount / 100);

       $data['dolar'] = $request->new_price / $cambio->exchange;

       $data['created_at'] = date('Y/m/d H:i:s');

       $this->repository->create($data);

       return redirect()->route('admim.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('Visualizar Produtos'))
        {
            return redirect()->back();
        }

        $product = ProductModel::find($id);

        if (!$product || $product->eliminado == 'yes') {
            return redirect()->back();
        }

        $extraImages = DB::select("SELECT id, image, product FROM extra_images_product_tb WHERE product={$id}");

        $categories = DB::select(" SELECT product_categorie_tb.description as name FROM product_categorie_tb, product_tb, product_subcategorie_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_tb.id = {$id}
        AND product_categorie_tb.id = product_subcategorie_tb.categorie GROUP BY name ");

        $subcategories = DB::select("SELECT name FROM product_subcategorie_tb WHERE id = '$product->subcategorie' ");

        $brands = DB::select("SELECT name FROM product_brand_tb WHERE id =' $product->brand' ");

        $colors = DB::select("SELECT * FROM color_tb ");

        $colorQtds = DB::select("SELECT * FROM product_color_tb WHERE product = {$id} ");

        $details = DB::select(" SELECT product_detail_tb.* FROM product_detail_tb, product_tb
        WHERE product_detail_tb.product = product_tb.id
        AND product_tb.id = {$id} ");

        foreach ($subcategories as $subcategorie) {
            $subcategorie->name;
        }

        foreach ($brands as $brand) {
            $brand->name;
        }

        return view('admim.products.showProduct', [
            'product' => $product,
            'extraImages' => $extraImages,
            'categories' => $categories,
            'subcategorie' => $subcategorie->name,
            'brand' => $brand->name,
            'colors' => $colors,
            'colorQtds' => $colorQtds,
            'details' => $details,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('Editar Produtos'))
        {
            return redirect()->back();
        }

        $product = ProductModel::find($id);

        if (!$product || $product->eliminado == 'yes') {
            return redirect()->back();
        }

        $subcategories = DB::select('SELECT * FROM product_subcategorie_tb');

        $brands = DB::select('SELECT * FROM product_brand_tb');

        //dd($product);

        return view('admim.products.editProduct', [
            'product' => $product,
            'subcategories' => $subcategories,
            'brands' => $brands
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies('Editar Produtos'))
        {
            return redirect()->back();
        }

        if(!$product = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $cambios = DB::select("SELECT * FROM exchange_tb");
        foreach ($cambios as $cambio) {
            $cambio->exchange;
        }

        $data = $request->all();


        if($request->hasFile('image') && $request->image->isValid())
        {
            if($product->image && Storage::exists($product->image))
            {
                Storage::delete($product->image);
            }

            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        }

        $data['qtd'] = $request->qtd;

       $data['qtd_init'] = $request->qtd;

        $data['new_price'] = $request->old_price - $request->old_price * ($request->discount / 100);

       $request->new_price = $request->old_price - $request->old_price * ($request->discount / 100);

        $data['dolar'] = $request->new_price / $cambio->exchange;

        $product->update($data);

       return redirect()->route('admim.products.show', $request->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('Apagar Produtos'))
        {
            return redirect()->back();
        }

        $product = $this->repository->where('id', $id)->first();

        if (!$product || $product->eliminado == 'yes') {
            return redirect()->back();
        }

        $extraImages = DB::select("SELECT extra_images_product_tb.image FROM extra_images_product_tb WHERE product={$id}");

        foreach($extraImages as $extraImage)
        {
            Storage::delete($extraImage->image);
        }

        if($product->image && Storage::exists($product->image))
        {
            Storage::delete($product->image);
        }

        // DB::select("UPDATE product_tb SET eliminado = 'yes' ,  status = 'offline'
        // WHERE id=$product->id");
        
        ProductModel::where('id', $product->id)->update(['eliminado' => 'yes','status' => 'offline']);

        return redirect()->route('admim.products.index');
    }

    public function online($id)
    {
        ProductModel::where('id', $id)->update(['status' => 'online']);

        return back();
    }

    public function offline($id)
    {
         ProductModel::where('id', $id)->update(['status' => 'offline']);

        return back();
    }

    public function slideShow()
    {
        $productsOff = ProductModel::where('slide', 'FALSE')->get();

        $productsOn = ProductModel::where('slide', 'TRUE')->get();

        return view('admim.products.slideShow', [
            'productsOn' => $productsOn,
            'productsOff' => $productsOff,
        ]);
    }

    public function slideShowOn(Request $request)
    {
        if( empty($request->id) )
        {
            $request->session()->flash('mensagem-falha', 'Nenhum item selecionado');
            return redirect()->route('admim.product.slideShow');
        }

        ProductModel::where([
            'slide' => 'FALSE',
        ])->whereIn('id', $request->id)->update(['slide' => 'TRUE']);

        return redirect()->route('admim.product.slideShow');
    }

    public function slideShowOff(Request $request)
    {
        if( empty($request->id) )
        {
            $request->session()->flash('mensagem-falha', 'Nenhum item selecionado');
            return redirect()->route('admim.product.slideShow');
        }

        ProductModel::where([
            'slide' => 'TRUE',
        ])->whereIn('id', $request->id)->update(['slide' => 'FALSE']);

        return redirect()->route('admim.product.slideShow');
    }
}
