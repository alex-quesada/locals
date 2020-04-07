<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago_planilla extends Model
{
    protected $table= 'pago_planillas';
    protected $fillable = [
        'fecha_pago',
        'salario_bruto',
        'salario_neto',
        'id_empleado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
