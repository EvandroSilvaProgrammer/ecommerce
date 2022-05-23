<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Gate;

class RoleController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Role $role)
    {
        $this->request = $request;
        $this->repository = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('Visualizar Funções') && Gate::denies('Cadastrar Funções'))
        {
            return redirect()->back();
        }

        $roles = Role::all();

        return view('admim.users.createRole', [
            'roles' => $roles,
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
        if(Gate::denies('Cadastrar Funções'))
        {
            return redirect()->back();
        }

        $data = $request->all();

       $this->repository->create($data);

       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('Visualizar Funções'))
        {
            return redirect()->back();
        }

        $role = Role::find($id);

        $allPermissions = DB::select(" SELECT * FROM permission WHERE permission.id NOT IN
        (SELECT permission_id FROM permission_role WHERE role_id = {$id}) ");

        if (!$role){ return redirect()->back(); }

        if($role->id == 1){ return redirect()->back();}

        $permissions = DB::select(" SELECT permission_role.id as id, permission.name as name,
         permission.label as label FROM permission_role, permission, role
        WHERE role_id=role.id AND permission_id=permission.id AND role.id={$id} ");

        return view('admim.users.showRole', [
            'role' => $role,
            'permissions' => $permissions,
            'allPermissions' => $allPermissions,
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
        if(Gate::denies('Editar Funções'))
        {
            return redirect()->back();
        }

        $role = Role::find($id);

        if (!$role){ return redirect()->back(); }

        if($role->id == 1){ return redirect()->back();}

        return view('admim.users.editRole', [
            'role' => $role,
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
        if(Gate::denies('Editar Funções'))
        {
            return redirect()->back();
        }

        if(!$role = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $role->update($data);

       return redirect()->route('admim.roles.show', $request->id);
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

        $role = $this->repository->where('id', $id)->first();

        if (!$role){ return redirect()->back(); }

        if($role->id == 1){ return redirect()->back();}

        $role->delete();

        return redirect()->route('admim.roles.index');
    }
}
