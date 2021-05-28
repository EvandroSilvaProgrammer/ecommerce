<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PermissionRole;
use Gate;

class PermissionRoleController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, PermissionRole $permission_role)
    {
        $this->request = $request;
        $this->repository = $permission_role;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('Adicionar Permissões'))
        {
            return redirect()->back();
        }

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
        if(Gate::denies('Apagar Permissões'))
        {
            return redirect()->back();
        }

        $permission_role = $this->repository->where('id', $id)->first();

        if(!$permission_role)
        {
            return redirect()->back();
        }

        $permission_role->delete();

        return back();
    }
}
