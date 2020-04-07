<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista_productos extends Model
{
    protected $table = 'lista_productos';
    protected $fillable = [
        'id_producto',
        'id_proveedor',
        'costo_producto',
    ];
}
