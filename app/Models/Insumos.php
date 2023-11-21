<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    use HasFactory;

    protected $table = 'inventario.insumos';

    protected $primaryKey = 'id_insumos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_proveedor',
        'id_estatus_insumos',
        'cantidad'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_insumos');
    }
}
