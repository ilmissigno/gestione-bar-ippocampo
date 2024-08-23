<?php

namespace App\Http\Controllers;

use App\Models\Tessere;
use App\Models\Acquisti;
use App\Models\Prodotti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function ajax(Request $request)
    {
        switch($request['type']){
            case 'getTessera':
                return $this->getInfoTessera($request);
            case 'insertPayment':
                return $this->makePayment($request);
            case 'export':
                return $this->printExportTable($request);
            default:
                break;
        }
    }

    protected function getInfoTessera(Request $request){
        $tess = Tessere::find($request['tessera']);
        if(isset($tess))
            return ['cliente' => $tess->socio, 'credito' => $tess->creditotess];
        else
            return ['cliente' => null, 'credito' => null];
    }

    protected function makePayment(Request $request){
        $list = $request['list'];
        $totale = $request['totale'];
        $codtess = $request['tessera'];
        $tr = true;
        foreach ($list as $codprod => $quantita) {
            //DECREMENTA QUANTITA' INVENTARIO
            $prod = Prodotti::find($codprod);
            $prod->quantitamag -= $quantita;
            if($prod->save()){
                $acq = Acquisti::create([
                    'prezzotot' => $prod->prezzo * $quantita,
                    'quantitatot' => $quantita,
                    'dataacq' => date('d/m/Y H:m'),
                    'nomeprod' => $prod->nomeprod,
                    'codtess' => $codtess,
                    'codprod' => $codprod,
                ]);
                if(!$acq){
                    $tr = false;
                    break;
                }
            }else{
                $tr = false;
                break;
            }
        }
        if(!$tr){
            //Error
            return [
                'status' => false,
                'list' => 'Errore inserimento acquisto',
                'totale' => 0
            ];
        }
        $tessera = Tessere::find($codtess);
        $tessera->creditotess -= $totale;
        if($tessera->save()){
            return [
                'status' => true,
                'list' => $list,
                'totale' => $totale
            ];
        }else{
            return [
                'status' => false,
                'list' => 'Errore decremento credito tessera',
                'totale' => 0
            ];
        }
    }

    protected function printExportTable(Request $request){
        $head = $request['head'];
        $body = $request['body'];

        // $acquisti = new AcquistiController();
        // $url = $acquisti->stampa_table();

        Session::put('head', null);
        Session::put('body', null);

        Session::put('head', $head);
        Session::put('body', $body);

        return [
            'status' => true,
            'url' => route('stampa_table'),
        ];
    }
}
