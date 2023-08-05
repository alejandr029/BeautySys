<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCita extends Model
{
    protected $table = 'estetico.tipo_cita';

    protected $primaryKey = 'id_tipo_cita';

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_cita',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_tipo_cita');
    }
}
