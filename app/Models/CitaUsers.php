<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaUsers extends Model
{
    use HasFactory;

    protected $table = 'estetico.cita';
    protected $primaryKey = 'id_cita';
    public $timestamps = false;

    protected $fillable = [
        'hora_cita', // Agregado para permitir asignación masiva
        'fecha_cita',
        'id_estado_cita',
        'id_sala',
        'id_tipo_cita',
        'id_personal',
        'id_insumos',
        'id_equipo',
    ];
}
