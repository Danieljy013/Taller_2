<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactanos extends Model
{
    protected $table = 'contactos';

    protected $fillable = [
        'nombre',
        'email',
        'mensaje'
    ];
}