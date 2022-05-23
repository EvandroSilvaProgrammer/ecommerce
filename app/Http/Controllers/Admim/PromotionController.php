<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\Promotion;
use Illuminate\Support\Facades\Storage;


class PromotionController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Promotion $promotion)
    {
        $this->request = $request;
        $this->repository = $promotion;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admim.promotions.promotion');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid())
        {
            $promotion = $this->repository->find(1);

            if( $promotion != NULL )
            {
                Storage::delete($promotion->image);

                $imagePath = $request->image->store('promotions');
 
                $data['image'] = $imagePath;
                
                $promotion->update($data);
            }

            else
            {
                $imagePath = $request->image->store('promotions');
 
                $data['image'] = $imagePath;

                $this->repository->create($data);
            }
        }

       return redirect()->back();
    }

    
}
