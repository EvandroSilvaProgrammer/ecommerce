<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use App\Http\Requests\categorieUpdateRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\ProductCategorieModel;
use Gate;

class ProductCategorieController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ProductCategorieModel $categorie)
    {
        $this->request = $request;
        $this->repository = $categorie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('Visualizar Categoria dos Produtos') && Gate::denies('Cadastrar Categoria dos Produtos'))
        {
            return redirect()->back();
        }

        $categories = ProductCategorieModel::where('eliminado', '=', 'no')->get();

        return view('admim.products.createProductsCategories', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categorieUpdateRequest $request)
    {
        if(Gate::denies('Cadastrar Categoria dos Produtos'))
        {
            return redirect()->back();
        }
       $data = $request->only('description');

       $this->repository->create($data);

       return redirect()->route('admim.productCategories.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('Editar Categoria dos Produtos'))
        {
            return redirect()->back();
        }
        $categorie = ProductCategorieModel::find($id);

        if (!$categorie || $categorie->eliminado == 'yes') {
            return redirect()->back();
        }

        return view('admim.products.editProductCategorie', [
            'categorie' => $categorie,
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
        if(Gate::denies('Editar Categoria dos Produtos'))
        {
            return redirect()->back();
        }
        if(!$categorie = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $categorie->update($data);

        return redirect()->route('admim.productCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('Apagar Categoria dos Produtos'))
        {
            return redirect()->back();
        }
        $categorie = $this->repository->where('id', $id)->first();

        if (!$categorie || $categorie->eliminado == 'yes') {
            return redirect()->back();
        }

        DB::select(" UPDATE product_categorie_tb SET eliminado = 'yes'
        WHERE id = $categorie->id ");

        return redirect()->route('admim.productCategories.index');
    }
}
