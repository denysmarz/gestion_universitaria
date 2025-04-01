<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'criterio_id',
        'indicador_id',
        'pregunta_id',
        'user_id',
        'responsable',
        'instancia',
        'documentos',
        'existe',
        'quien_elabora',
        'info_complementaria',
        'respuesta',
        'evidencias'
    ];

    // Relaciones con Criterio, Indicador y Pregunta
    public function criterio()
    {
        return $this->belongsTo(Criterio::class);
    }

    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
