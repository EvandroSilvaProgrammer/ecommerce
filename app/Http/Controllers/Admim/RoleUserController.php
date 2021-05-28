<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RoleUser;
use Gate;

class RoleUserController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, RoleUser $role_user)
    {
        $this->request = $request;
        $this->repository = $role_user;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Cadastrar Funções'))
        {
            return redirect()->back();
        }
        //dd($request->all());

        $data = $request->all();

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
        if(Gate::denies('Apagar Funções'))
        {
            return redirect()->back();
        }

        $role_user = $this->repository->where('id', $id)->first();

        if(!$role_user)
        {
            return redirect()->back();
        }

        $role_user->delete();

        return back();
    }
}
