<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\SupplyingProductModel;

class SupplyingProductController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, SupplyingProductModel $supplyingProduct)
    {
        $this->request = $request;
        $this->repository = $supplyingProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplyingsProducts = DB::select("SELECT * FROM supplying_product_tb");
        $supplyings = DB::select("SELECT * FROM supplying_tb");
        $products = DB::select("SELECT * FROM product_tb");

//dd($supplyings);
        return view('admim.supplyings.createSupplyingProduct', [
            'supplyingsProducts' => $supplyingsProducts,
            'supplyings' => $supplyings,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

       $this->repository->create($data);

        //Pesquisar um método para fazer refresh na página
        return back();
       //return redirect()->route('admim.supplyingProduct.index');
    }

    public function newSupply(Request $request, $id)
    {
        $supplyings = DB::select("SELECT * FROM supplying_tb WHERE id = {$id} ");

        $supplyingsProducts = DB::select("SELECT * FROM supplying_product_tb WHERE supplying = {$id}");
        $products = DB::select("SELECT * FROM product_tb");

        return view('admim.supplyings.createSupplyingProduct', [
            'supplyingsProducts' => $supplyingsProducts,
            'supplyings' => $supplyings,
            'products' => $products,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplyingProduct = SupplyingProductModel::find($id);

        $supplyings = DB::select("SELECT * FROM supplying_tb");
        $products = DB::select("SELECT * FROM product_tb");

        return view('admim.supplyings.editSupplyingProduct', [
            'supplyingProduct' => $supplyingProduct,
            'supplyings' => $supplyings,
            'products' => $products,
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
        if(!$supplyingProduct = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $supplyingProduct->update($data);

        return redirect()->route('admim.supplyingProduct.newSupply', $request->supplying);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = $this->repository->where('id', $id)->first();


        if(!$id)
        {
            return redirect()->back();
        }

        DB::delete("DELETE FROM supplying_product_tb WHERE id = '$id->id' ");

        return back();
    }
}
