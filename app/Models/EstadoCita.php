<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCita extends Model
{
    protected $table = 'estado_cita';

    protected $primaryKey = 'id_estado_cita';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_estado_cita');
    }
}
