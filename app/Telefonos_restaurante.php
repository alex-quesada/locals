<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefonos_restaurante extends Model
{
    protected $primaryKey = 'telefono_restaurante';
    protected $table = 'telefonos_restaurantes';
    
    protected $fillable = [
        'telefono_restaurante',
        'id_restaurante',
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
