<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AddImagesServiceModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Gate;

class AddImagesServiceController extends Controller
{
    public function __construct(Request $request, AddImagesServiceModel $service)
    {
        $this->request = $request;
        $this->repository = $service;
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

       if($request->hasFile('image') && $request->image->isValid())
       {
           $imagePath = $request->image->store('images/extras');
           $data['image'] = $imagePath;
       }

       $this->repository->create($data);

       return redirect()->route('admim.services.show',$request->service);
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

        $extraImage = $this->repository->where('id', $id)->first();

        if($extraImage->image && Storage::exists($extraImage->image))
        {
            Storage::delete($extraImage->image);
        }

        $extraImage->delete();

        return redirect()->route('admim.services.show', $extraImage->service);
    }
}
