<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\SupplyModel;
use Illuminate\Support\Facades\Storage;

use Gate;

class SupplyController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, SupplyModel $supply)
    {
        $this->request = $request;
        $this->repository = $supply;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Cadastrar Fornecimento'))
        {
            return redirect()->back();
        }

        $data = $request->all();

        if($request->hasFile('pdf') && $request->pdf->isValid())
       {
           $pdfPath = $request->pdf->store('PDFS/Fornecimentos');

           $data['pdf'] = $pdfPath;
       }

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
        if(Gate::denies('Apagar Fornecimento'))
        {
            return redirect()->back();
        }
        $supply = $this->repository->where('id', $id)->first();

        if(!$supply)
        {
            return redirect()->back();
        }

        if($supply->pdf && Storage::exists($supply->pdf))
        {
            Storage::delete($supply->pdf);
        }

        $supply->delete();

        return back();
    }
}
