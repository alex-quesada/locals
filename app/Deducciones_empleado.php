<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deducciones_empleado extends Model
{
    protected $table = 'deducciones_empleados';
    protected $fillable = [
        'deduccion',
        'id_deducciones',
        'id_empleado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function deducciones()
    {
        return $this->belongsTo(Deducciones::class);
    }
}
