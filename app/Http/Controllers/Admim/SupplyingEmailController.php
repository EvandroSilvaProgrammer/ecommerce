<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\SupplyingEmailModel;
use Gate;

class SupplyingEmailController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, SupplyingEmailModel $supplyingEmail)
    {
        $this->request = $request;
        $this->repository = $supplyingEmail;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Cadastrar Email do Fornecedor'))
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
        if(Gate::denies('Apagar Email do Fornecedor'))
        {
            return redirect()->back();
        }

        $supplyingEmail = $this->repository->where('id', $id)->first();

        if(!$supplyingEmail)
        {
            return redirect()->back();
        }

        DB::delete("DELETE FROM supplying_email_tb WHERE id = '$supplyingEmail->id' ");

        return redirect()->route('admim.supplying.show', $supplyingEmail->supplying);
    }
}
