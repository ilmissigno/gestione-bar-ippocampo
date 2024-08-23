<?php

namespace App\Http\Controllers;

use App\Models\Soci;
use App\Models\Tessere;
use App\Models\Ricariche;
use Illuminate\Http\Request;

class RicaricheController extends Controller
{
    public function view($param)
    {
        switch($param){
            case "view_crediti":
                $ricariche = Tessere::all();
                return view("view_crediti",compact('ricariche'));
            case "view_ric_giorno":
                $ricariche = Ricariche::where('dataricarica','like',date('d/m/Y').'%')->get();
                return view("view_ric_giorno",compact('ricariche'));
            case "view_ric_tot":
                $ricariche = Ricariche::all();
                return view("view_ric_tot",compact('ricariche'));
            case "view_ric_data":
                return view($param);
            case "view_ric_tessera":
                return view($param);
            case "view_ric_tessera_data":
                return view($param);
            case "delete_all_ricariche":
                $this->delete_all_ricariche();
                return redirect()->route('inventario2',['parametro'=>'view_ricariche'])->with('msg', 'Ricariche cancellate con successo');
            default:
                break;
        }
    }

    public function view_ric_tessera(Request $request){
        $codtess = $request->input('codtess');
        $tess = Tessere::where(['codtess'=>$codtess])->first();
        $ricariche = $tess->ricariche;
        $nome = $tess->socio->nome;
        $cognome = $tess->socio->cognome;
        return view('view_ric_tessera',compact('ricariche','nome','cognome'));
    }
    public function view_ric_data(Request $request){
        $dataric = $request->input('data_ric');
        $dat = date('d/m/Y',strtotime($dataric));
        $ricariche = Ricariche::where('dataricarica','like',$dat.'%')->get();
        return view('view_ric_data',compact('ricariche'));
    }
    public function view_ric_tessera_data(Request $request){
        $codtess = $request->input('codtess');
        $dataric = $request->input('data_ric');
        $dat = date('d/m/Y',strtotime($dataric));
        $ricariche = Ricariche::where('dataricarica','like',$dat.'%')->where(['codtess'=>$codtess])->get();
        return view('view_ric_tessera_data',compact('ricariche'));
    }

    public function delete_ricarica($ricarica_id){
        $ricarica = Ricariche::where('idricarica','=',$ricarica_id)->first();
        if($ricarica->delete()){
            return redirect()->route('inventario2',['parametro'=>'view_ricariche'])->with('msg', 'Ricarica cancellata con successo');
        }else{
            return redirect()->route('inventario2',['parametro'=>'view_ricariche'])->with('msg', 'Errore nella cancellazione della ricarica..');
        }
    }

    public function delete_all_ricariche(){
        $ricariche = Ricariche::all();
        foreach($ricariche as $ric){
            $ric->delete();
        }
    }

}
