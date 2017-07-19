<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }

    public function mostrarLogin(){
        return view('auth.admin-login');
    }
    public function login(Request $request){
        //validar los datos del form
        $this->validate($request,[
            'email'=> 'required|email',
            'password'=>'required'
        ]);
        //intentar iniciar sesion
        if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password], $request->remember)){
        //si el inicio de sesion es exitoso, redirigir al adminhome

        return redirect()->intended(route('/admin'));
        }
        //si no es exitoso entonces redirigir a loginform
        return redirect()->back()->withInput($request->only('email', 'remember'));
        
    }
}
