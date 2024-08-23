<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tessere;
use App\Models\Ricariche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RicaricaController extends Controller
{

    public function crea_ricarica(Request $request)
    {
        $data = $request['list'];
        $codtess = $data['codice'];
        $importo = $data['ricarica'];
        $tess = Tessere::find($codtess);
        $tess->creditotess += $importo;
        $tess->ricaricatot += $importo;
        $tess->ricaricagiorno = $importo;
        $tess->dataricarica = date('d/m/Y H:m');
        if($tess->save()){
            $ric = Ricariche::create([
                'ricarica' => $importo,
                'dataricarica' => date('d/m/Y H:m'),
                'codtess' => $codtess,
                'tiporicarica' => 'BAR'
            ]);
            if($ric){
                return ['status'=>true, 'msg' => "Ricarica effettuata con successo"];
            }else{
                return ['status' => false, 'msg' => 'Impossibile effettuare la ricarica..'];
            }
        }else{
            return ['status' => false, 'msg' => 'Tessera non esistente!'];
        }
    }

    public function getdati(Request $request){
        $tesserafinale = Tessere::find($request['tessera']);
        return [
            'cliente' => $tesserafinale->socio,
            'tessera' => $tesserafinale,
            'success' => true
        ];
    }
}
