<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    protected $fillable = [
        'nombre_ciudad',
        'id_pais',
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'id_pais');
    }
}
