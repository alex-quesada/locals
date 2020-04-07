<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas_diarias extends Model
{
    protected $table = 'ventas_diarias';
    protected $fillable = [
        'id_combo',
        'fecha_venta',
    ];

    public function combo()
    {
        return $this->belongsTo(Combo::class);
    }
}
