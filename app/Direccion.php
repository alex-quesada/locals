<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $primaryKey = 'id_direccion';
    protected $table = 'direcciones';
    protected $fillable = [
        'id_ciudad',
        'direccion_uno',
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
