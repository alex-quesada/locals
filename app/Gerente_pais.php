<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gerente_pais extends Model
{
    protected $table = 'gerente_pais';
    protected $fillable = [
        'id_empleado',
        'id_pais',
        'salario',
    ];

    public function pais()
    {
        return $this->hasOne(Pais::class);
    }
    public function empleado()
    {
        return $this->hasOne(Empleado::class);
    }
}
