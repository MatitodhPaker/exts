<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\alumnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
>>>>>>> 8c7f721e11f047f2450f4efe5ee698bb8ccf0cb8

class exts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
<<<<<<< HEAD
    {   
        $items = alumnos::all();
        $titulo = 'Inicio';
        $appbartitle = 'Departamento de extraescolares';
        $id_usuario=Auth::user()->id;
        return view('modules/exts/inicio', compact('titulo','appbartitle','id_usuario', 'items'));
        
=======
    {
        //
        $titulo='inicio';
        Alert::success('holi', 'crayoli');
        return view('welcome',compact('titulo'));
>>>>>>> 8c7f721e11f047f2450f4efe5ee698bb8ccf0cb8
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
