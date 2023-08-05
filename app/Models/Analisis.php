<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    protected $table = 'estetico.analisis';
    protected $primaryKey = 'id_analisis';
    use HasFactory;
}
