<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    protected $primaryKey = 'id_restaurante';
    protected $table = 'restaurantes'; 
    protected $fillable = [
        'id_direccion',
    ];

    public function Direccion()
    {
        return $this->hasOne(Direccion::class);
    }

    public function telefonos()
    {
        return $this->hasMany(Telefonos_restaurante::class, 'id_restaurante', 'id_restaurante');
    }
}
