<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\alumnos;
use App\Models\creditos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class liberacion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $item = new creditos();
        $item->credito = $request ->tipo_credito;
        $item->estado = $request -> estado;
        $item->horas = $request -> horas_totales;
        $item->id_alumno = $request -> id_alumno;
        $item->save();
        // return redirect('/inicio')->with('success', 'Datos ingresados');
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
        $item = creditos::find($id);
        $item->credito = $request ->tipo_credito;
        $item->estado = $request -> estado;
        $item->horas = $request -> horas_totales;
        $item->id_alumno = $request -> id_alumno;
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
        //
    }
    public function liberar($id, $type) {
        $datoslib = alumnos::find($id);
        $datosliberacion = creditos::where('id_alumno','=',$id)->where('credito', '=', $type)->first();
        $datosuser = User::find($id);
        $str= $datosliberacion->updated_at;
        $div = explode(" ",$str);
        $fecha = explode("-",$div[0]);
        $mes = ($fecha[1] == 1 ? 'Enero':
                ($fecha[1] == 2 ? 'Febrero': 
                ($fecha[1] == 3 ? 'Marzo':
                ($fecha[1] == 4 ? 'Abril':
                ($fecha[1] == 5 ? 'Mayo': 
                ($fecha[1] == 6 ? 'Junio':
                ($fecha[1] == 7 ? 'Julio': 
                ($fecha[1] == 8 ? 'Agosto': 
                ($fecha[1] == 9 ? 'Septiembre': 
                ($fecha[1] == 10 ? 'Octubre': 
                ($fecha[1] == 11 ? 'Noviembre':'Diciembre')))))))))));
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView("pdf/credito_liberado", [
            "nombre" => $datoslib->nombre.' '.$datoslib->paterno.' '.$datoslib->materno,
            "no_control" => $datoslib->no_control,
            "credito" => $datosliberacion->credito,
            "carrera"=>$datoslib->carrera,
            //"fecha" => date('Y-m-d'),
            "estado"=>$datosliberacion->estado,
            "horas"=>$datosliberacion->horas,
            "usuario"=>$datosuser->user_name,
            "dia" => ($fecha[2])." de ".($mes)." del ".($fecha[0]),
            "dia2" => "a los ".($fecha[2])." dias del mes de ".($mes)." del año ".($fecha[0])
        ]);
        return $dompdf->stream();
    }
}
