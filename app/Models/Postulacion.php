<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';

    protected $fillable = [
        'nombre',
        'apellidos',
        'edad',
        'sexo',
        'email',
        'telefono',
        'departamento',
        'ciudad',
        'cargo',
        'empresa',
        'ciudad_empresa',
        'experiencia',
        'logros',
        'idiomas',
        'motivacion'
    ];
}