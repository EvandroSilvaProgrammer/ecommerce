<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;

class AboutUsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = DB::select(" SELECT * FROM about_doriema ");

        return view('admim.info.createAboutUs', [
            'about' => $about
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
        if(Gate::denies('Cadastrar informações da empresa'))
        {
            return redirect()->back();
        }
        
        DB::update("UPDATE about_doriema SET description='$request->description' ");

       return redirect()->route('admim.sobrenos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $about = DB::select(" SELECT * FROM about_doriema ");

        return view('site.info.aboutUs', [
            'about' => $about
        ]);
    }
}
