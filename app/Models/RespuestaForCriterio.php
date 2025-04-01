<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaForCriterio extends Model
{
    use HasFactory;

    protected $table = 'respuestas_for_criterios';
    
    protected $fillable = [
        'criterio_id',
        'user_id',
        'problematica',
        'estrategia',
        'mecanismo',
        'accion',
        'responsable',
        'fecha_p',
    ];


    public function criterio()
    {
        return $this->belongsTo(Criterio::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
