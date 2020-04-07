<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefonos_empleado extends Model
{
    protected $primaryKey = 'telefono_empleado';
    protected $table = 'telefonos_empleados';
    protected $fillable = [
        'telefono_empleado',
        'tipo_telefono',
        'id_persona',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }
}
