<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas_diarias_acompaniamiento extends Model
{
    protected $table='ventas_diarias_acompaniamientos';
    protected $fillable = [
        'id_ventas_diarias',
        'id_producto',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function ventas_diarias()
    {
        return $this->belongsTo(Ventas_diarias::class);
    }
}
