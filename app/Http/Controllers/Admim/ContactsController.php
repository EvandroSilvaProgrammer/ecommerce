<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Gate;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        return view('admim.info.createContacts', [
            'contacts' => $contacts
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
        if(Gate::denies('Cadastrar Categoria dos Produtos'))
        {
            return redirect()->back();
        }
        DB::update("UPDATE contacts_doriema SET phone_number='$request->phone_number', email='$request->email', adress='$request->adress' ");

       return redirect()->route('admim.contacts.index');
    }
}
