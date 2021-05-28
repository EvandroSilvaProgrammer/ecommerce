<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use App\Http\Requests\fornecedorUpdateRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\SupplyingModel;
use App\Models\DistrictModel;
use Gate;

class SupplyingController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, SupplyingModel $supplying)
    {
        $this->request = $request;
        $this->repository = $supplying;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('Cadastrar Fornecedores') && Gate::denies('Visualizar Fornecedores'))
        {
            return redirect()->back();
        }

        $provinces = DB::select("SELECT * FROM province_tb");
        $supllyings = DB::select("SELECT * FROM supplying_tb");
        $districts = DB::select("SELECT * FROM district_tb");

        return view('admim.supplyings.createSupplyings', [
            'provinces' => $provinces,
            'supllyings' => $supllyings,
            'districts' => $districts
        ]);
    }

    public function getDistricts(Request $request, $id)
    {
        if($request->ajax())
        {
            $districts = DB::select("SELECT * FROM district_tb WHERE province={$id}");
            return response()->json($districts);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(fornecedorUpdateRequest $request)
    {
        if(Gate::denies('Cadastrar Fornecedores'))
        {
            return redirect()->back();
        }

        $data = $request->all();

       $this->repository->create($data);

       return redirect()->route('admim.supplying.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('Visualizar Fornecedores'))
        {
            return redirect()->back();
        }

        $supplying = SupplyingModel::find($id);

        if (!$supplying || $supplying->eliminado == 'yes') {
            return redirect()->back();
        }

        $districts = DB::select("SELECT * FROM district_tb");

        $provinces = DB::select("SELECT * FROM province_tb");

        $supplyingTelephones = DB::select("SELECT * FROM supplying_telephone_tb WHERE supplying = {$id}");

        $supplyingEmails = DB::select("SELECT * FROM supplying_email_tb WHERE supplying = {$id}");

        $supplyProducts = DB::select(" SELECT * FROM supply_tb WHERE supplying = {$id} ");

        return view('admim.supplyings.showSupplying', [
            'supplying' => $supplying,
            'districts' => $districts,
            'provinces'=> $provinces,
            'supplyingTelephones' => $supplyingTelephones,
            'supplyingEmails' => $supplyingEmails,
            'supplyProducts' =>$supplyProducts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('Editar Fornecedores'))
        {
            return redirect()->back();
        }
        $supplying = SupplyingModel::find($id);

        if (!$supplying || $supplying->eliminado == 'yes') {
            return redirect()->back();
        }

        $districts = DB::select("SELECT * FROM district_tb");

        $provinces = DB::select("SELECT * FROM province_tb");

        return view('admim.supplyings.editSupplying', [
            'supplying' => $supplying,
            'provinces'=> $provinces,
            'districts' => $districts,
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
        if(Gate::denies('Editar Fornecedores'))
        {
            return redirect()->back();
        }
        if(!$supplying = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $supplying->update($data);


        return redirect()->route('admim.supplying.show', $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('Apagar Fornecedores'))
        {
            return redirect()->back();
        }
        $supplying = $this->repository->where('id', $id)->first();

        if (!$supplying || $supplying->eliminado == 'yes') {
            return redirect()->back();
        }

        DB::select("UPDATE supplying_tb SET eliminado = 'yes'
        WHERE id=$supplying->id");

        return redirect()->route('admim.supplying.index');
    }
}
