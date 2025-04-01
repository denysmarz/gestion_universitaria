<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'dimension'];

    public function indicadores()
    {
        return $this->hasMany(Indicador::class, 'criterio_id');
    }
    public function respuestasForCriterios() {
        return $this->hasMany(RespuestaForCriterio::class, 'criterio_id');
    }
    public function respuestasOporCriterios() {
        return $this->hasMany(RespuestaOporCriterio::class, 'criterio_id');
    }
}
