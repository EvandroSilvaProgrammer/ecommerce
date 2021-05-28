<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gate;
use App\Models\Taxa;

class TaxaController extends Controller
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
        
        Taxa::where('id', 1)->update([
            'percent' => $request->percent
        ]);

        //DB::update("UPDATE percent SET percent='$request->percent' ");
        
        

        return back();
    }
}
