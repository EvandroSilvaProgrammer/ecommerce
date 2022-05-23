<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceModel;
use Gate;

class ServiceController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ServiceModel $service)
    {
        $this->request = $request;
        $this->repository = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('Visualizar Serviços') && Gate::denies('Cadastrar Serviços'))
        {
            return redirect()->back();
        }

        $services = DB::select("SELECT * FROM service_tb");

        return view('admim.services.createServices',
        [
            'services' => $services,
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

        if(Gate::denies('Cadastrar Serviços'))
        {
            return redirect()->back();
        }

       $data = $request->all();

       if($request->hasFile('image') && $request->image->isValid())
       {
           //$imageName = $request->name . '_' . $request->id . '.' . $request->image->extension();

           $imagePath = $request->image->store('images');

           $data['image'] = $imagePath;
       }

       $this->repository->create($data);

       return redirect()->route('admim.services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('Visualizar Serviços'))
        {
            return redirect()->back();
        }

        $service = ServiceModel::find($id);

        if (!$service || $service->eliminado == 'yes') {
            return redirect()->back();
        }

        $extraImages = DB::select("SELECT id, image, service FROM extra_images_service_tb WHERE service={$id}");

        return view('admim.services.showService', [
            'service' => $service,
            'extraImages' => $extraImages
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
        if(Gate::denies('Editar Serviços'))
        {
            return redirect()->back();
        }

        $service = ServiceModel::find($id);

        if (!$service || $service->eliminado == 'yes') {
            return redirect()->back();
        }

        return view('admim.services.editService', [
            'service' => $service
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
        if(Gate::denies('Editar Serviços'))
        {
            return redirect()->back();
        }

        if(!$service = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid())
        {
            if($service->image && Storage::exists($service->image))
            {
                Storage::delete($service->image);
            }

            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        }

        $service->update($data);

       return redirect()->route('admim.services.show', $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('Apagar Serviços'))
        {
            return redirect()->back();
        }

        $service = $this->repository->where('id', $id)->first();

        if (!$service || $service->eliminado == 'yes') {
            return redirect()->back();
        }

        if($service->image && Storage::exists($service->image))
        {
            Storage::delete($service->image);
        }

        DB::select("UPDATE service_tb SET eliminado = 'yes' ,  status = 'Offline'
        WHERE id=$service->id");

        return redirect()->route('admim.services.index');
    }
}
