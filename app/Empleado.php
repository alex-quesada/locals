<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $primaryKey = 'id_empleado';
    protected $table= 'empleados';
    protected $fillable = [
        'fecha_ingreso',
        'id_persona',
        'id_tipo_empleado',
        'id_restaurante',
        'salario_por_hora',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
    public function tipo_empleado()
    {
        return $this->belongsTo(Tipo_empleado::class);
    }
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
