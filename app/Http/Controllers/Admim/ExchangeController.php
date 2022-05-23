<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Gate;

class ExchangeController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Gate::denies('Actualizar Taxa de Câmbio'))
        {
            return  redirect()->back();
        }

        DB::update("UPDATE exchange_tb SET exchange='$request->exchange' ");

        return back();
    }
}
