<?php

namespace App\Http\Controllers;

use App\Models\Utenti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UtentiController extends Controller
{
    public function view($param)
    {
        switch($param){
            case 'change_password':
                return view('change_password');
            case 'registration_user':
                return view('registration_user');
            default:
                break;
        }
    }

    public function cambiaPassword(Request $request){
        $username = $request['name'];
        $password = $request['password'];
        $user = Utenti::where(['username'=>$username])->first();
        $user->password = bcrypt($password);
        if($user->save())
            return redirect()->route('inventario2',['parametro'=>'view_utenti'])->with('msg', 'Password modificata correttamente');
        else
            return redirect()->route('inventario2',['parametro'=>'view_utenti'])->with('msg', 'Errore modifica della password');
    }

    public function registrazione(Request $request){
        $user = Utenti::create([
            'username' => $request->input()['username'],
            'password' => bcrypt($request->input()['password']),
            'dataregistrazione' => date('d/m/Y'),
            'datalogin' => null,
            'privilegio' => 'avanzato',
        ]);
        if($user)
            return redirect()->route('inventario2',['parametro'=>'view_utenti'])->with('msg', 'Utente registrato correttamente');
        else
            return redirect()->route('inventario2',['parametro'=>'view_utenti'])->with('msg', 'Errore registrazione utente');
    }
}
