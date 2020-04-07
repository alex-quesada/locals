<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista_proveedores extends Model
{
    protected $table = 'lista_proveedores';
    protected $fillable = [
        'id_proveedor',
        'id_restaurante',
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
