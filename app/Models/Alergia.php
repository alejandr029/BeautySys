<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    protected $table = 'usuario.alergia';
    protected $primaryKey = 'id_alergia';
    use HasFactory;
}
