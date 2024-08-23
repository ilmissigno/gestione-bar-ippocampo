<?php

namespace App\Http\Controllers;

use App\Models\Prodotti;
use Illuminate\Http\Request;

class ProdottiController extends Controller
{
    public function view($param)
    {
        switch($param){
            case "insert_prodotto":
                $categorie = Prodotti::CATEGORIES;
                return view($param,compact('categorie'));
            case "view_prodotti":
                $prod = Prodotti::all();
                return view($param,compact('prod'));
            case "update_rif_prodotto":
                $prod = Prodotti::all();
                return view($param,compact('prod'));
            case "view_prod_categoria":
                $categorie = Prodotti::CATEGORIES;
                return view($param,compact('categorie'));
                break;
            default:
                break;
        }
    }

    public function insert_prodotto(Request $request){
        $prod = Prodotti::create([
            'codbarre'=>$request['codbarre'],
            'nomeprod'=>$request['nomeprod'],
            'quantitatot'=>$request['quantita'],
            'quantitamag'=>$request['quantita'],
            'prezzo'=>$request['prezzo'],
            'prezzoven'=>$request['prezzo'],
            'categoria'=>$request['categoria']
        ]);
        if($prod)
            return redirect()->route('inventario2',['parametro'=>'view_prodotti'])->with('msg', 'Prodotto inserito con successo');
        else
            return redirect()->route('inventario2',['parametro'=>'view_prodotti'])->with('msg', 'Impossibile inserire il prodotto..');
    }

    public function view_prod_categoria(Request $request){
        $cat = $request->input('categoria');
        $categ = Prodotti::where(['categoria'=>$cat])->get();
        $categorie = Prodotti::CATEGORIES;
        return view('view_prod_categoria',compact('categ','categorie'));
    }

    public function update_rif_prodotto(Request $request){
        $quant_nuova = $request['rifornimento'];
        $codice = $request['codprod'];
        $prod = Prodotti::find($codice);
        $prod->quantitatot += $quant_nuova;
        $prod->quantitamag += $quant_nuova;
        if($prod->save()){
            return redirect()->route('inventario2',['parametro'=>'view_prodotti'])->with('msg', 'Rifornimento effettuato con successo');
        }else{
            return redirect()->route('inventario2',['parametro'=>'view_prodotti'])->with('msg', 'Impossibile effettuare rifornimento del prodotto..');
        }
    }

    public function delete_prodotto($codprod){
        $prod = Prodotti::find($codprod);
        if($prod->delete()){
            return redirect()->route('inventario2',['parametro'=>'view_prodotti'])->with('msg', 'Prodotto cancellato con successo');
        }else{
            return redirect()->route('inventario2',['parametro'=>'view_prodotti'])->with('msg', 'Errore nella cancellazione del prodotto..');
        }
    }

}
