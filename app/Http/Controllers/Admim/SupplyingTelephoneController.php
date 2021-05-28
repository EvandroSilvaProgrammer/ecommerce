<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\SupplyingTelephoneModel;
use Gate;

class SupplyingTelephoneController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, SupplyingTelephoneModel $supplyingTelephone)
    {
        $this->request = $request;
        $this->repository = $supplyingTelephone;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Cadastrar Telefone do Fornecedor'))
        {
            return redirect()->back();
        }

        $data = $request->all();

       $this->repository->create($data);

       return redirect()->route('admim.supplying.show', $request->supplying);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('Apagar Telefone do Fornecedor'))
        {
            return redirect()->back();
        }

        $supplyingTelephone = $this->repository->where('id', $id)->first();

        if(!$supplyingTelephone)
        {
            return redirect()->back();
        }

        DB::delete("DELETE FROM supplying_telephone_tb WHERE id = '$supplyingTelephone->id' ");

        return redirect()->route('admim.supplying.show', $supplyingTelephone->supplying);
    }
}
