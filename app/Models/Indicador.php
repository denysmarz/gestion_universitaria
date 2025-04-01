<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;
    protected $table = 'indicadores';

    protected $fillable = ['criterio_id', 'nombre', 'descripcion'];

    public function criterio()
    {
        return $this->belongsTo(Criterio::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
