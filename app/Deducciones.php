<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deducciones extends Model
{
    protected $table = 'deducciones';
	protected $primaryKey = 'id_deduccion';
    protected $fillable = [
        'detalle',
        'porcentaje',
    ];
	public function empleado()
    {
        return $this->belongsToMany(Empleado::class, 'deducciones_empleado','id_deduccion','id_empleado');
    }
}
