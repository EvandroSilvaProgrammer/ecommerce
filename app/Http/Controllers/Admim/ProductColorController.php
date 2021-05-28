<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\ProductColorModel;
use Gate;

class ProductColorController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ProductColorModel $color)
    {
        $this->request = $request;
        $this->repository = $color;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Adicionar Categoria de Cores'))
        {
            return redirect()->back();
        }

        $query = DB::select("SELECT * FROM color_tb WHERE color='$request->color' ");
        foreach ($query as $color) {
            $color->id;
        }

        $data = $request->only('color', 'product', 'qtd');

        $data['color'] = $color->id;

        $this->repository->create($data);

        return redirect()->route('admim.products.show', $request->product);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($color)
    {
        if(Gate::denies('Apagar Categoria de Cores'))
        {
            return redirect()->back();
        }

        $color = $this->repository->where('color', $color)->first();

        if(!$color)
        {
            return redirect()->back();
        }

        DB::delete("DELETE FROM product_color_tb WHERE color = '$color->color' ");

        return redirect()->route('admim.products.show', $color->product);
    }
}
