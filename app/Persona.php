<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $primaryKey = 'id_persona';
    protected $table ='personas';
    protected $fillable = [
        'id_persona',
        'nombre',
        'apellido_uno',
        'apellido_dos',
        'correo',
        'id_direccion',
    ];

    public function Direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function telefonos()
    {
        return $this->hasMany(Telefonos_empleado::class, 'id_persona', 'id_persona');
    }
}
