<?php

namespace App\Http\Controllers;

use App\Models\Prodotti;
use Illuminate\Http\Request;

class Select2SearchController extends Controller
{
    public function selectSearch(Request $request){
        $prodotti = [];
        if($request->has('q')){
            $search = $request->get('q');
            $prodotti = Prodotti::select('codbarre','codprod','nomeprod','prezzo','categoria','quantitatot')->where('nomeprod','LIKE','%'.$search.'%')->orWhere('codbarre','LIKE','%'.$search.'%')->where('quantitamag','>',0)->get();
        }else{
            $prodotti = Prodotti::select('codbarre','codprod','nomeprod','prezzo','categoria','quantitatot')->where('quantitamag','>',0)->get();
        }
        return response()->json($prodotti);
    }

    public function get_products_by_cat(Request $request){
        $prodotti = Prodotti::select('codprod','nomeprod')->where('categoria','LIKE','%'.$request['list'].'%')->get();
        return response()->json($prodotti);
    }

}
