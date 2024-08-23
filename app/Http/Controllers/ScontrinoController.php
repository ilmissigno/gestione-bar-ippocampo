<?php

namespace App\Http\Controllers;

use App\Models\Tessere;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Helpers\ScontrinoHelper;

class ScontrinoController extends Controller
{
    public function scontrino(Request $request){
        $type = $request['type'];
        if(strcmp($type,"acquisto")==0){
            if(ScontrinoHelper::createScontrinoAcquisto($request))
                return true;
        }elseif(strcmp($type,"ricarica")==0){
            if(ScontrinoHelper::createScontrinoRicarica($request))
                return true;
        }
    }
}
