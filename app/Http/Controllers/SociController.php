<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Soci;
use App\Models\Acquisti;
use Illuminate\Http\Request;

class SociController extends Controller
{
    public function view($param)
    {
        switch($param){
            case "insert_socio":
                return view('insert_socio');
            case "view_soci":
                $soci = Soci::all();
                return view("view_soci",compact('soci'));
            case "delete_socio":
                $soci = Soci::all();
                return view("delete_socio",compact('soci'));
            case "view_tessere_socio":
                return view($param);
            case "view_acq_socio":
                return redirect("inventario_acquisti/view_acq_soci");
            case "view_acq_socio_data":
                return view($param);
            default:
                break;
        }
    }

    public function insert_socio(Request $request){
        $socio = Soci::create([
            'nome' => $request->input('nome'),
            'cognome' => $request->input('cognome'),
            'telefono' => $request->input('telefono')
        ]);
        if($socio){
            return redirect()->route('inventario2',['parametro'=>'view_soci'])->with('msg', 'Socio inserito con successo');
        }else{
            return redirect()->route('inventario2',['parametro'=>'view_soci'])->with('msg', 'Errore inserimento socio..');
        }
    }

    public function delete_socio(Request $request){
        $tess = Soci::where('codcli','=',$request->input()['codcli'])->first();
        if($tess->delete()){
            return redirect()->route('inventario2',['parametro'=>'view_soci'])->with('msg', 'Socio cancellato con successo');
        }else{
            return redirect()->route('inventario2',['parametro'=>'view_soci'])->with('msg', 'Impossibile cancellare il Socio');
        }
    }

    public function view_tessere_socio(Request $request){
        if($request->input('nomesocio') === null){
            $socio = Soci::where(['cognome'=>$request->input('cognomesocio')])->get();
            $tessere = [];
            foreach($socio as $s){
                foreach($s->tessere as $k){
                    array_push($tessere, $k);
                }
            }
            return view('view_tessere_socio',compact('tessere'));
        }else if($request->input('nomesocio') !== null && $request->input('cognomesocio') !== null){
            $socio = Soci::where(['nome'=>$request->input('nomesocio'),'cognome'=>$request->input('cognomesocio')])->first();
            $tessere = $socio->tessere;
            return view('view_tessere_socio',compact('tessere'));
        }
    }

    public function view_acq_socio_data(Request $request){
        $nomesocio = $request->input('nomesocio');
        $cognomesocio = $request->input('cognomesocio');
        $dataacq = $request->input('data_acq');
        $dat = date('d/m/Y',strtotime($dataacq));
        $acq = [];
        foreach(Acquisti::where('dataacq','like',$dat.'%')->get() as $acquisti){
            if($acquisti->tessera->socio->nome == $nomesocio && $acquisti->tessera->socio->cognome == $cognomesocio)
                array_push($acq,$acquisti);
        }
        return view('view_acq_socio_data',compact('acq'));
    }
}
