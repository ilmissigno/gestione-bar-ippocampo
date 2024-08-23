<?php

namespace App\Helpers;

use Exception;
use App\Models\Tessere;
use App\Models\Prodotti;
use Mike42\Escpos\Printer;
use Illuminate\Http\Request;
use Mike42\Escpos\EscposImage;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ScontrinoHelper
{

    public const SHARED_THERMAL_PRINTER = "EPSON TM-T20II Receipt";

    protected static function sendToPrinter($content){
        try{
            $img = EscposImage::load(public_path('storage/Immagine_scontrino.png'));
            $connector = new WindowsPrintConnector(self::SHARED_THERMAL_PRINTER);
            $printer = new Printer($connector);
            $printer->initialize();
            $printer->bitImage($img);
            $printer->text($content);
            $printer->feed();
            $printer->cut();
            $printer->close();
        }catch(Exception $e){
            dd("Impossibile inviare alla stampante : ".$e->getMessage()."\n");
        }
    }

    public static function createScontrinoAcquisto(Request $request){
        $codtess = $request['tessera'];
        $data = $request['list'];
        $totale = $request['totale'];
        $tessModel = Tessere::where(['codtess'=>$codtess])->first();
        if(!Storage::disk('local')->exists('scontrini')){
            Storage::disk('local')->makeDirectory("scontrini");
        }
        $file_location = "scontrini/scontrino_acquisto.txt";
        $content = "\r\n";
        $content .= "\r\n";
        $content .= "Codice Tessera : " . $codtess . "\r\n";
        $content .= "\r\n";
        $content .= "Socio : " . $tessModel->socio->nome . " " . $tessModel->socio->cognome ."\r\n";
        $content .= "\r\n";
        $content .= "Credito Precedente : " . number_format($tessModel->creditotess+$totale,2,'.',',') . " €" ."\r\n";
        $content .= "\r\n";
        $content .= "Acquisti : " . "\r\n";
        $content .= "\r\n";
        foreach($data as $key=>$quantita){
            $prod = Prodotti::find($key);
            $content .= $prod->nomeprod . " x " . $quantita . " " . number_format($prod->prezzo,2,'.',',') . " €";
            $content .= "\r\n";
        }
        $content .= "\r\n\r\n";
        $content .= "Credito Residuo : " . number_format($tessModel->creditotess,2,'.',',') . " €" ."\r\n";
        $content .= "\r\n\r\n";
        $content .= "Totale : " . $totale . " €" . "\r\n";
        $content .= "\r\n";
        $content .= "-----SCONTRINO NON FISCALE-----" . "\r\n";
        $content .= "\r\n";
        $content .= "Bar Club Ippocampo";
        Storage::put($file_location,$content);
        self::sendToPrinter($content);
        return true;
    }

    public static function createScontrinoRicarica(Request $request){
        $data = $request['list'];
        $codtess = $data['codice'];
        $importo = $data['ricarica'];
        if(!Storage::disk('local')->exists('scontrini')){
            Storage::disk('local')->makeDirectory("scontrini");
        }
        $tess = Tessere::find($codtess);
        $file_location = "scontrini/scontrino_ricarica.txt";
        $content = "\r\n";
        $content .= "\r\n";
        $content .= "Codice Tessera : " . $codtess . "\r\n";
        $content .= "\r\n";
        $content .= "\r\n";
        $content .= "Socio : " . $tess->socio->cognome . "  " . $tess->socio->nome . "\r\n";
        $content .= "\r\n";
        $content .= "Credito Precedente : " . number_format($tess->creditotess-$importo,2,'.',',') . " €" ."\r\n";
        $content .= "\r\n";
        $content .= "Ricarica : " . $importo . " €" . "\r\n";
        $content .= "\r\n";
        $content .= "Credito Attuale : " . $tess->creditotess . " €" . "\r\n";
        $content .= "\r\n";
        $content .= "-----SCONTRINO NON FISCALE-----" . "\r\n";
        $content .= "\r\n";
        $content .= "Bar Club Ippocampo";
        Storage::put($file_location,$content);
        self::sendToPrinter($content);
        return true;
    }

}

?>
