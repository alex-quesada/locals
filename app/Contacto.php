<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{

    protected $table = 'contactos';
	protected $primaryKey = 'id_contacto';
    protected $fillable = [
        'id_proveedor',
        'id_persona',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class,'id_persona');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class,'id_proveedor');
    }
}
