<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_combo extends Model
{
    protected $table = 'producto_combos';
    protected $fillable = [
        'id_producto',
        'id_combo',
        'precio_combo',
        'acompaniamiento',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function combo()
    {
        return $this->belongsTo(Combo::class);
    }
}
