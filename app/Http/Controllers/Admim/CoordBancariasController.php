<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use App\Models\CoordBancarias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Gate;

class CoordBancariasController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, CoordBancarias $coordenadas)
    {
        $this->request = $request;
        $this->repository = $coordenadas;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coords = DB::select(" SELECT * FROM coord_bancarias ");

        return view('admim.info.coordBancarias', [
            'coords' => $coords
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Cadastrar Coordenadas Bancárias'))
        {
            return redirect()->back();
        }
       $data = $request->all();

       $this->repository->create($data);

       return redirect()->route('admim.coordenadas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('Editar Coordenadas Bancárias'))
        {
            return redirect()->back();
        }
        $coordenada = CoordBancarias::find($id);

        return view('admim.info.editCoordBancarias', [
            'coordenada' => $coordenada,
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
        if(Gate::denies('Editar Coordenadas Bancárias'))
        {
            return redirect()->back();
        }
        if(!$coordenada = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $coordenada->update($data);

        return redirect()->route('admim.coordenadas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
