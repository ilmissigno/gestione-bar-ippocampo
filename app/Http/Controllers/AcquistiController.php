<?php

namespace App\Http\Controllers;

use App\Models\Soci;
use App\Models\Acquisti;
use App\Models\Prodotti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcquistiController extends Controller
{
    public $acq;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Prodotti::all();

        return view('acquisti', compact('product'));
    }

    public function view($param){
        switch ($param){
            case "view_acq_soci":
                return view($param);
                break;
            case "view_acq_giorno":
                $acquisti = Acquisti::where('dataacq','like','%'.date("d/m/Y").'%')->get();
                return view('inventario_acquisti',compact('acquisti'));
                break;
            case "view_orders":
                $acquisti = Acquisti::all();
                return view('inventario_acquisti',compact('acquisti'));
                break;
            case "delete_acquisti":
                $this->delete_all_acquisti();
                return redirect()->route('inventario2',['parametro'=>'view_acquisti'])->with('msg', 'Acquisti cancellati con successo');
                break;
        }
    }

    public function view_acq_soci(Request $request){
        $nomesocio = $request->input('nomesocio');
        $cognomesocio = $request->input('cognomesocio');
        $acq = [];
        $socio = Soci::where('nome','like','%'.$nomesocio.'%')->where('cognome','like','%'.$cognomesocio.'%')->first();
        foreach($socio->tessere as $tess){
            foreach($tess->acquisti as $a){
                array_push($acq,$a);
            }
        }
        krsort($acq);
        return view('view_acq_soci',compact('acq'));
    }

    public function getProductsCategory(Request $request){
        $prod = Prodotti::where(['categoria'=>$request['categoria']])->get();
        return ['status'=>true,'list'=>$prod];
    }

    public function view_acq_prod(Request $request){
        $categoria = $request->input('categoria');
        $prodotto = $request->input('prodotto');

        if (empty($categoria) && empty($prodotto)) {
            $acquisti = Acquisti::all();
            $model = Prodotti::all();
            return view('view_acq_prod', compact('model', 'acquisti'));
        } elseif(!empty($categoria) && $prodotto == '*') {
            $model = Prodotti::where(['categoria'=>$categoria])->get();
            $acquisti = [];
            foreach($model as $prod){
                foreach($prod->acquisti as $ac)
                    array_push($acquisti,$ac);
            }
            return view('view_acq_prod', compact('model', 'acquisti'));
        }else if(empty($categoria) || empty($prodotto)){
            $model = Prodotti::all();
            $acquisti = Acquisti::all();
            return view('view_acq_prod', compact('model', 'acquisti'));
        }else{
            $model = Prodotti::where(['codprod'=>$prodotto])->first();
            $acquisti = $model->acquisti;
            return view('view_acq_prod', compact('model', 'acquisti'));
        }
    }

    public function stampa_table()
    {
        return view('stampa_table');
    }

    public function delete_acquisto($idacq){
        $acq = Acquisti::where('codacq','=',$idacq)->first();
        if($acq->delete()){
            return redirect()->route('inventario2',['parametro'=>'view_acquisti'])->with('msg', 'Acquisto cancellato con successo');
        }else{
            return redirect()->route('inventario2',['parametro'=>'view_acquisti'])->with('msg', "Errore nella cancellazione dell'acquisto..");
        }
    }

    public function delete_all_acquisti(){
        $all_acq = Acquisti::all();
        foreach($all_acq as $acq){
            $acq->delete();
        }
    }

}
