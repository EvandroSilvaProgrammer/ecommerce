<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use App\Http\Requests\brandUpdateRequest;
use App\Models\ProductBrandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBrandController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, ProductBrandModel $brand)
    {
        $this->request = $request;
        $this->repository = $brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = ProductBrandModel::all()->where('eliminado', '=', 'no');

        $subcategories = DB::select("SELECT * FROM product_subcategorie_tb ");

        return view('admim.products.createProductsBrands', [
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(brandUpdateRequest $request)
    {
        $data = $request->all();

       $this->repository->create($data);

       return redirect()->route('admim.productBrands.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = ProductBrandModel::find($id);

        if (!$brand || $brand->eliminado == 'yes') {
            return redirect()->back();
        }

        return view('admim.products.editProductBrand', [
            'brand' => $brand,
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
        if(!$brand = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $brand->update($data);

        return redirect()->route('admim.productBrands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->repository->where('id', $id)->first();

        if (!$brand || $brand->eliminado == 'yes') {
            return redirect()->back();
        }

        DB::select("UPDATE product_brand_tb SET eliminado = 'yes'
        WHERE id=$brand->id");

        return redirect()->route('admim.productBrands.index');
    }
}
