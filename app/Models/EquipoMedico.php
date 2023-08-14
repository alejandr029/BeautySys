<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoMedico extends Model
{
    use HasFactory;

    protected $table = 'inventario.equipo_medico';

    protected $primaryKey = 'id_equipo_medico';

    protected $fillable = [
        'nombre',
        'descripcion',
        'modelo',
        'marca',
        'cantidad',
        'id_estado_equipo',
        'id_proveedor'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_equipo_medico');
    }
}
