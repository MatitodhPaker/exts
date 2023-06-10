<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\alumnos;
use App\Models\evidencias as ModelsEvidencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class evidencias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type, $id)
    {
        $titulo = $type;
        $items = alumnos::find($id);
        $items_table = ModelsEvidencias::where('id_alumno','=',$id)->where('credito', '=', $type)->get();
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
        $ruta = '';
        $item = new ModelsEvidencias();
        $item->credito = $request ->credito;
        $item ->tipo_evidencia = $request -> tipo_evidencia;
        $item->nombre_archivo = $request->nombre_archivo;
        $item->ubicacion_carpeta=$request->carpeta;
        $item->horas_asignadas = $request->horas_asignadas;
        $item->id_user = $request->id_user;
        $item->id_alumno = $request->id_alumno;

        if($request->tipo_evidencia == 'mooc' ){
            $ruta = 'moocs';
        }else{
            $ruta = 'archivos';
        }

        if($request->hasFile('archivo')){
            $item->ubicacion_archivo = $request->file('archivo')->store($request->credito.'/'.$ruta);
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
        $items_table = ModelsEvidencias::find($id);
        return view('edit_evidencias', compact('items', 'titulo'));
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
        $item = ModelsEvidencias::find($id);
        $item ->tipo_evidencia = $request -> tipo_evidencia;
        $item->credito = $request ->credito;
        $item->horas_asignadas = $request->horas_asignadas;
        //$item->archivo = $request ->archivo;
        $item->nombre_archivo = $request->nombre_archivo;
        //$item->mooc = $request->mooc;
        $item->nombre_mooc = $request->nombre_mooc;
        $item->carpeta=$request->carpeta;
        $item->estado = $request->estado;
        //file->archivo->originalName
        if($request->hasFile('archivo')){
            $item->archivo = $request->file('archivo')->store('archivo');
            // $item->archivo = $request->file('archivo')->getClientOriginalName();
            // $request->file('archivo')->storeAs('archivos', $item->archivos);
        }
        if($request->hasFile('mooc')){
            $item->mooc = $request->file('mooc')->store('mooc');
            // $item->mooc = $request->file('mooc')->getClientOriginalName();
            // $request->file('mooc')->storeAs('mooc', $item->mooc);
        }
        $item->save();
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
        $item = ModelsEvidencias::find($id);
        Storage::delete($item->archivo);
        Storage::delete($item->mooc);
        $item->delete();
        return redirect('/inicio');
    }
    
}
