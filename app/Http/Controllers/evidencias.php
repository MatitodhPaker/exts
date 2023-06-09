<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\alumnos;
use App\Models\evidencias as ModelsEvidencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class evidencias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $titulo = 'Creditos';
        $items = alumnos::find($id);
        $items_table = ModelsEvidencias::where('id_alumno','=',$id)->get();
        $appbartitle = 'Departamento de extraescolares';
        $id_usuario = Auth::user()->id;
        return view('modules/exts/creditos', compact('items_table','items', 'titulo', 'appbartitle', 'id_usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $item = new ModelsEvidencias();
        $item ->tipo_evidencia = $request -> tipo_evidencia;
        $item->credito = $request ->credito;
        $item->horas_asignadas = $request->horas_asignadas;
        //$item->archivo = $request ->archivo;
        $item->nombre_archivo = $request->nombre_archivo;
        //$item->mooc = $request->mooc;
        $item->nombre_mooc = $request->nombre_mooc;
        $item->carpeta=$request->carpeta;
        $item->id_user = $request->id_user;
        $item->id_alumno = $request->id_alumno;
        $item->estado = $request->estado;
        //file->archivo->originalName
        if($request->hasFile('archivo')){
            $item->archivo = $request->file('archivo')->store('public/archivos');
        }

        if($request->hasFile('mooc')){
            $item->mooc = $request->file('mooc')->store('public/archivos');
        }

        $item->save();
        return redirect('/inicio')->with('success', 'Datos ingresados');
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
        $titulo = 'Actualizar';
        $items = ModelsEvidencias::find($id);
        return view('edit_evidencias', compact('items', 'titulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_evidencias(Request $request, $id)
    {
        $item = ModelsEvidencias::find($id);
        $item ->tipo_evidencia = $request -> tipo_evidencia;
        $item->credito = $request ->credito;
        $item->horas_asignadas = $request->horas_asignadas;

        //$item->archivo = $request ->archivo;
        $item->nombre_archivo = $request->nombre_archivo;
        //$item->mooc = $request->mooc;
        $item->nombre_mooc = $request->nombre_mooc;
        $item->carpeta=$request->carpeta;
        $item->id_user = $request->id_user;
        $item->id_alumno = $request->id_alumno;
        $item->estado = $request->estado;
        //file->archivo->originalName
        if($request->hasFile('archivo')){
            $item->archivo = $request->file('archivo')->store('archivos');
        }

        if($request->hasFile('mooc')){
            $item->mooc = $request->file('mooc')->store('archivos');
        $item->save();
        // alert()->success('Actualizado','Datos Actualizados');
        return redirect('/inicio')->with('success', 'Datos ingresados');
        }
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
