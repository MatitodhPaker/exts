<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\alumnos;
use App\Models\creditos;
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
        $horas = ModelsEvidencias::where('id_alumno', '=',$id)->where('credito', '=', $type)->sum('horas_asignadas');
        $conteo_mooc = 0;
        $credito = creditos::where('id_alumno', '=', $id)->where('credito', '=', $type)->first();

        foreach($items_table as $moocs)
        {
            // echo $moocs->tipo_evidencia;
            if ($moocs->tipo_evidencia == 'mooc') {
                $conteo_mooc +=1;
            }
        
        }

        return view('modules/exts/creditos', compact('items_table','items', 'titulo', 'appbartitle', 'id_usuario','horas', 'conteo_mooc', 'credito'));
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
        }else if($request->tipo_evidencia == 'liberado'){
            $ruta = 'liberados';
        }else{
            $ruta = 'archivos';
        }

        if($request->hasFile('archivo')){
            $item->ubicacion_archivo = $request->file('archivo')->store($request->credito.'/'.$ruta);
        }

        $item->save();
        // return redirect('/inicio')->with('success', 'Datos ingresados');
        // TODO: ALERTA AQUI
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
        $ruta = '';
        $item = ModelsEvidencias::find($id);
        $item->credito = $request ->credito;
        $item ->tipo_evidencia = $request->tipo_evidencia;
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
        // return redirect('/inicio')->with('success', 'Datos ingresados');
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
        $item = ModelsEvidencias::find($id);
        Storage::delete($item->archivo);
        Storage::delete($item->mooc);
        $item->delete();
        return redirect('/inicio');
    }
    
}
