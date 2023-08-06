<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'estetico.cita';
    protected $primaryKey = 'id_cita';
    public $timestamps = false;

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    // Relación con el modelo Personal
    public function personal()
    {
        return $this->belongsTo(Personal::class, 'id_personal', 'id_personal');
    }

    // Relación con el modelo EstadoCita
    public function estadoCita()
    {
        return $this->belongsTo(EstadoCita::class, 'id_estado_cita', 'id_estado_cita');
    }

    // Relación con el modelo Sala
    public function sala()
    {
        return $this->belongsTo(Sala::class, 'id_sala', 'id_sala');
    }

    // Relación con el modelo TipoCita
    public function tipoCita()
    {
        return $this->belongsTo(TipoCita::class, 'id_tipo_cita', 'id_tipo_cita');
    }

    public function doctor()
    {
        return $this->belongsTo(TipoCita::class, 'id_tipo_cita', 'id_tipo_cita');
    }
}
