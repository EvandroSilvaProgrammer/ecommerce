<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExtraImagesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateRequest;

use Gate;

class ExtraImagesController extends Controller
{
    public function __construct(Request $request, ExtraImagesModel $product)
    {
        $this->request = $request;
        $this->repository = $product;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Adicionar Imagens'))
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
        if(Gate::denies('Apagar Imagens'))
        {
            return redirect()->back();
        }

        $extraImage = $this->repository->where('id', $id)->first();

        if($extraImage->image && Storage::exists($extraImage->image))
        {
            Storage::delete($extraImage->image);
        }

        $extraImage->delete();

        return redirect()->route('admim.products.show', $extraImage->product);
    }
}
