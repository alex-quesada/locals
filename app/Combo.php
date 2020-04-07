<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $table = 'combos';
	protected $primaryKey = 'id_pais';
    protected $fillable = [
        'nombre',
        'precio_combo',
    ];
	
	public function producto_combo()
    {
        return $this->hasMany(Producto_combo::class, 'id_producto_combo');
    }
	public function ventas_diarias()
    {
        return $this->hasMany(Ventas_diarias::class, 'id_ventas_diarias');
    }
}
