<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acquisti extends Model
{
    use HasFactory;

    protected $table = 'acquisti';
    protected $primaryKey = 'codacq';
    public $timestamps = false;
    protected $fillable = ['codacq','prezzotot','quantitatot','dataacq','nomeprod','codtess','codprod'];

    public function prodotto(){
        return $this->belongsTo(Prodotti::class,'codprod','codprod');
    }

    public function tessera(){
        return $this->belongsTo(Tessere::class,'codtess','codtess');
    }

}
