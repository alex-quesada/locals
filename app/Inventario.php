<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';
    protected $fillable = [
        'cantidad_min',
        'cantidad',
        'id_lista_productos',
        'id_restaurante',
    ];

    public function lista_productos()
    {
        return $this->belongsTo(Lista_productos::class);
    }
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
