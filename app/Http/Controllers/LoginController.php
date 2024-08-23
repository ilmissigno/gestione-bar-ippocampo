<?php

namespace App\Http\Controllers;

use App\Models\Utenti;
use Illuminate\Http\Request;
use App\Models\Login as LoginM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request){
        $data = $request->only('username','password');
        // dd(Auth::attempt($data,$request->remember));
        if(Auth::attempt($data,$request->remember)){
            $user = Utenti::where(['username'=>$request->input('username')])->first();
            $user->datalogin = date('d/m/Y H:i');
            $user->save();
            return view('home');
        } else {
            return Redirect::back()->withErrors(['msg'=>'Controllare username e/o password..']);
        }
    }
    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function username(){
        return 'username';
    }

}
