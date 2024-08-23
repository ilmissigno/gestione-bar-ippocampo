<?php

namespace App\Http\Controllers;

use App\Models\Soci;
use App\Models\Tessere;
use Illuminate\Http\Request;

class TessereController extends Controller
{
    public function view($param)
    {
        switch($param){
            case "insert_tessera":
                $soci = Soci::all();
                return view($param,compact('soci'));
            case "view_tessere":
                $tess = Tessere::all();
                return view($param,compact('tess'));
            case "delete_tessera":
                return view($param);
            case "delete_all_tessere":
                $this->delete_all_tessere();
                return redirect()->route('inventario2',['parametro'=>'view_tessere'])->with('msg', 'Tessere cancellate con successo');
            case "reset_crediti":
                $this->reset_crediti();
                return redirect()->route('inventario2',['parametro'=>'view_tessere'])->with('msg', 'Crediti azzerati con successo');
            default:
                break;
        }
    }

    public function delete_tessera(Request $request){
        $tess = Tessere::where('codtess','=',$request->input()['codtess'])->first();
        if(isset($tess)){
            foreach($tess->acquisti() as $acq){
                $acq->delete();
            }
            foreach($tess->ricariche() as $ric){
                $ric->delete();
            }
            if($tess->delete()){
                return redirect()->route('inventario2',['parametro'=>'view_tessere'])->with('msg', 'Tessera cancellata con successo');
            }else{
                return redirect()->route('inventario2',['parametro'=>'view_tessere'])->with('msg', 'Impossibile cancellare la tessera');
            }
        }
    }

    public function reset_crediti(){
        $all_tess = Tessere::all();
        foreach($all_tess as $tess){
            $tess->creditotess = 0.0;
            $tess->save();
        }
    }
    public function delete_all_tessere(){
        $all_tess = Tessere::all();
        foreach($all_tess as $tess){
            $tess->acquisti()->delete();
            $tess->ricariche()->delete();
            $tess->delete();
        }
    }

    public function insert_tessera(Request $request){
        $socio = Soci::where('nome','like','%'.$request->input('nomesocio').'%')->where('cognome','like','%'.$request->input('cognomesocio').'%')->first();
        if(!isset($socio)){
            $socio = Soci::create([
                'nome' => $request->input('nomesocio'),
                'cognome' => $request->input('cognomesocio'),
                'telefono' => '0',
            ]);
        }
        $tess = Tessere::create([
            'codtess' => $request->input('codtess'),
            'creditotess'=> $request->input('creditotess'),
            'tipotessera'=> $request->input('tipotessera'),
            'ricaricagiorno'=> $request->input('creditotess'),
            'ricaricatot'=> $request->input('creditotess'),
            'dataricarica'=> gmdate('d/m/Y H:m'),
            'codcli'=> $socio->codcli
        ]);
        if($tess){
            return redirect()->route('inventario2',['parametro'=>'view_tessere'])->with('msg', 'Tessera inserita con successo');
        }else{
            return redirect()->route('inventario2',['parametro'=>'view_tessere'])->with('msg', 'Errore inserimento tessera..');
        }
    }

}
