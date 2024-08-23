<?php

namespace App\Models;

use App\Models\Soci;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tessere extends Model
{
    use HasFactory;

    protected $table = 'tessere';
    protected $primaryKey = 'codtess';
    protected $fillable = ['codtess','creditotess','ricaricagiorno','ricaricatot','dataricarica','tipotessera','codcli'];
    public $timestamps = false;

    public function socio(){
        return $this->belongsTo(Soci::class,'codcli','codcli');
    }

    public function acquisti(){
        return $this->hasMany(Acquisti::class,'codtess','codtess');
    }

    public function ricariche(){
        return $this->hasMany(Ricariche::class,'codtess','codtess');
    }

}
