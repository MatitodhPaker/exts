<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\alumnos;
use Illuminate\Http\Request;

class registro extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulo='Inicio';
        $items = alumnos::all();
        return view ('inicio',compact('titulo','items'));
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
        $item = new alumnos();
        $item ->nombre = $request->nombre;
        $item ->paterno = $request->paterno;
        $item ->materno = $request->materno;
        $item ->no_control = $request->no_control;
        $item ->telefono = $request->telefono;
        $item ->carrera = $request->carrera;
        $item ->fecha_nacimiento = $request->fecha_nacimiento;
        $item ->media_superior = $request->media_superior;
        $item ->fecha_ingreso_tec= $request-> fecha_ingreso_tec;
        // $item ->fecha = $request->fecha; 
        if ($request->input('nombre') == '' || $request->input('paterno') == ''|| $request->input('materno') == ''|| $request->input('no_control') == '' || $request->input('telefono') == ''
        || $request->input('carrera')== ''||$request->input('fecha_nacimiento')==''|| $request->input('media_superior')== ''|| $request->input('fecha_ingreso_tec')=='') {
            // Redirigir a la pestaña de nuevo con Sweet Alert de error
            // alert()->error('Campos vacios','vuelve a intentarlo');
            return redirect('/inicio')->with('error', 'Por favor, completa todos los campos');
        } else {
            // Redirigir a la pestaña de éxito con Sweet Alert de éxito
            $item->save();
            // alert()->success('Guardado','Datos guardados');
            return redirect('/inicio')->with('success', 'Datos ingresados');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $titulo = "Eliminar";
        $items = alumnos::find($id);
        return view("eliminar", compact('items', 'titulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $titulo = 'Actualizar';
        $items = alumnos::find($id);
        return view('edit', compact('items', 'titulo'));
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
        $item = alumnos::find($id);
        $item ->nombre = $request->nombre;
            $item ->paterno = $request->paterno;
            $item ->materno = $request->materno;
            $item ->no_control = $request->no_control;
            $item ->telefono = $request->telefono;
            $item ->carrera = $request->carrera;
            $item ->fecha_nacimiento = $request->fecha_nacimiento;
            $item ->media_superior = $request->media_superior;
            $item ->fecha_ingreso_tec= $request-> fecha_ingreso_tec;
        $item->save();
        // alert()->success('Actualizado','Datos Actualizados');
        return redirect('/inicio')->with('success', 'Datos ingresados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = alumnos::find($id);
        $item->delete();
        
        return redirect('/inicio');
    }
}
