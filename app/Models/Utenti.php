<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utenti extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'utenti';
    protected $primaryKey = 'username';

    protected $fillable = ['username','password','dataregistrazione','datalogin','privilegio'];
    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

}
