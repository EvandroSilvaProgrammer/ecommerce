<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DetailModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Gate;

class DetailController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, DetailModel $detail)
    {
        $this->request = $request;
        $this->repository = $detail;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Adicionar Imagens ao Serviço'))
        {
            return redirect()->back();
        }

        $data = $request->all();

       $this->repository->create($data);


       return redirect()->route('admim.products.show',$request->product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('Apagar Imagens do Serviço'))
        {
            return redirect()->back();
        }

        $detail = $this->repository->where('id', $id)->first();

        $detail->delete();

        return redirect()->route('admim.products.show',$detail->product);
    }
}
