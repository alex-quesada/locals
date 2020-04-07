<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horas_trabajadas extends Model
{
    protected $primaryKey = 'id_horas_trabajadas';
    protected $table ='horas_trabajadas';
    protected $fillable = [
        'fecha_trabajada',
        'horas_simples',
        'horas_tiempo_medio',
        'horas_extra',
        'id_empleado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
