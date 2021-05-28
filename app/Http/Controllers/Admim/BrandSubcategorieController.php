<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BrandSubcategorie;
use Gate;

class BrandSubcategorieController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, BrandSubcategorie $brand_subcategorie)
    {
        $this->request = $request;
        $this->repository = $brand_subcategorie;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Adicionar Marcas a Subcategria'))
        {
            return redirect()->back();
        }

        $data = $request->all();

       $this->repository->create($data);

       return back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('Apagar Marcas a Subcategria'))
        {
            return redirect()->back();
        }

        $brand_subcategorie = $this->repository->where('id', $id)->first();

        if(!$brand_subcategorie)
        {
            return redirect()->back();
        }

        $brand_subcategorie->delete();

        return back();
    }
}
