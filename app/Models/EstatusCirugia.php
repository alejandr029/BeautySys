<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusCirugia extends Model
{
    protected $table = 'estetico.Estatus_cirugia';
    protected $primaryKey = 'id_estatus_cirugia';
    use HasFactory;
}
