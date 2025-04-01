<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = ['indicador_id', 'pregunta'];

    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
