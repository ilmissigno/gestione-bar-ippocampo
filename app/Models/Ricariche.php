<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ricariche extends Model
{
    use HasFactory;

    protected $table = 'ricariche';
    protected $primaryKey = 'idricarica';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['ricarica','dataricarica','codtess','tiporicarica','dataricaricacena'];

    public function tessera(){
        return $this->belongsTo(Tessere::class,'codtess','codtess');
    }
}
