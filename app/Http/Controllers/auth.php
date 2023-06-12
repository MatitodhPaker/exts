<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class Auth extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulo = 'Login';
        $appbartitle = 'departamento de extraescolares';
        Alert::info('Paara iniciar', 'Debera ingresar un usuario registrado');
        return view('modules/auth/login', compact('titulo','appbartitle'));
    }

    public function nuevo_usuario(){
        $item = new User();
        $item->name = 'DAE';
        $item->email = 'ext_milpaalta2@tecnm.mx';
        $item->password = Hash::make('12345678');
        $item->user_name = 'Roldan Aquino Segura';
        $item->save();
        Alert::success('Exito', 'Usuario creado con exito');
        return $item;
    }
    public function logout(){
        FacadesAuth::logout();
        Session::flush();
        Alert::warning('Logout', 'Esta seguro de que quieres cerrar session');
        return redirect()->route('login');
    }
    public function logear(Request $request) {
        $credenciales = $request->only("name", "password");
        if (FacadesAuth::attempt($credenciales)) {
            Alert::success('Exito', 'Inicio de session exitoso');
            return redirect()->route('inicio');
        } else {
            $titulo = 'Login';
            $appbartitle = 'departamento de extraescolares';
            return view('modules/auth/login', compact('titulo','appbartitle'));
        }
    }
}