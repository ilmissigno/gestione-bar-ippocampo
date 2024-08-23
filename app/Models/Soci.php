<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soci extends Model
{
    use HasFactory;

    protected $table = 'clienti';
    protected $fillable = ['codcli','nome','cognome','telefono'];
    protected $primaryKey = 'codcli';
    public $timestamps = false;

    public function tessere(){
        return $this->hasMany(Tessere::class,'codcli','codcli');
    }

}
