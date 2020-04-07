<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_empleado extends Model
{
    protected $primaryKey = 'id_tipo_empleado';
    protected $table = 'tipo_empleados';
    protected $fillable = [
        'nombre_puesto',
    ];
}
