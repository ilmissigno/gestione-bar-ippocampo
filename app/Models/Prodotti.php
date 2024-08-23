<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodotti extends Model
{
    use HasFactory;

    protected $table = 'prodotti';
    public $timestamps = false;
    protected $primaryKey = 'codprod';
    public $incrementing = true;
    protected $fillable = ['codbarre','nomeprod','quantitatot','quantitamag','prezzo','prezzoven','categoria'];

    public const CATEGORIES = ['GELATI','BAR','SNACK','ATTIVITA','BIBITE','CENA'];

    public function acquisti(){
        return $this->hasMany(Acquisti::class,'codprod','codprod');
    }

}
