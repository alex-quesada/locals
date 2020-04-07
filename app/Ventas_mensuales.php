<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas_mensuales extends Model
{
    protected $table= 'ventas_mensuales';
    protected $fillable = [
        'mes',
        'anio',
        'id_producto',
        'id_restaurante',
        'cantidad',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
