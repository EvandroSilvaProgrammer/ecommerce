<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use App\Http\Requests\subCategorieUpdateRequest;
use App\Models\ProductSubCategorieModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSubCategorieController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, ProductSubCategorieModel $subcategorie)
    {
        $this->request = $request;
        $this->repository = $subcategorie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = ProductSubCategorieModel::all()->where('eliminado', 'no');

        $categories = DB::select("SELECT * FROM product_categorie_tb ");

        return view('admim.products.createProductsSubCategories', [
            'subcategories' => $subcategories,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(subCategorieUpdateRequest $request)
    {
        $data = $request->all();

       $this->repository->create($data);

       return redirect()->route('admim.productSubCategories.index');
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

        if (!$subcategorie || $subcategorie->eliminado == 'yes') {
            return redirect()->back();
        }

        $categories = DB::select("SELECT * FROM product_categorie_tb ");

        $brands = DB::select(" SELECT * FROM product_brand_tb WHERE product_brand_tb.id NOT IN
        (SELECT brand FROM brand_subcategorie_tb WHERE subcategorie = {$id}) ");

        $brandsSubcategorie = DB::select(" SELECT brand_subcategorie_tb.id as id, product_brand_tb.name as name
        FROM brand_subcategorie_tb, product_brand_tb, product_subcategorie_tb
        WHERE brand_subcategorie_tb.brand = product_brand_tb.id
        AND brand_subcategorie_tb.subcategorie = product_subcategorie_tb.id
        AND brand_subcategorie_tb.subcategorie = {$id} ");

        return view('admim.products.showProductSubCategorie', [
            'subcategorie' => $subcategorie,
            'categories' => $categories,
            'brands' => $brands,
            'brandsSubcategorie' => $brandsSubcategorie,
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
        $subcategorie = ProductSubCategorieModel::find($id);

        if (!$subcategorie || $subcategorie->eliminado == 'yes') {
            return redirect()->back();
        }

        $categories = DB::select(" SELECT * FROM product_categorie_tb ");

        return view('admim.products.editProductSubCategorie', [
            'subcategorie' => $subcategorie,
            'categories' => $categories
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
        if(!$subcategorie = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $subcategorie->update($data);

        return redirect()->route('admim.productSubCategories.show', $subcategorie->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategorie = $this->repository->where('id', $id)->first();

        if (!$subcategorie || $subcategorie->eliminado == 'yes') {
            return redirect()->back();
        }

        DB::select(" UPDATE product_subcategorie_tb SET eliminado = 'yes'
        WHERE id = $subcategorie->id ");

        return redirect()->route('admim.productSubCategories.index');
    }
}
