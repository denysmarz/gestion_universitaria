<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criterio;
use App\Models\RespuestaForCriterio;
use App\Models\RespuestaOporCriterio;
use Illuminate\Support\Facades\Auth;
class CriterioController extends Controller
{
    public function dimension_a($dimension)
    {
        // Obtener los criterios con sus indicadores, preguntas y respuestas previas del usuario autenticado
        $criterios = Criterio::with([
            'indicadores.preguntas.respuestas' => function ($query) {
                $query->where('user_id', auth()->id());
            }
        ])->where('dimension', $dimension)->get();
        // Obtener el usuario autenticado
        $usuario = auth()->user();
        return view('criterios.dimension_a', compact('criterios', 'usuario'));
    }


    public function criterio_a($criterio){
        //dd($criterio);
        // Obtener criterios con sus indicadores, preguntas y respuestas previas del usuario autenticado
        $criterios = Criterio::with([
            'indicadores.preguntas.respuestas' => function ($query) {
                $query->where('user_id', auth()->id());
            }
        ])->where('dimension', $criterio)->get();
        $respuestas = RespuestaForCriterio::where('user_id', Auth::id())->get(); // Obtener respuestas del usuario autenticado
        return view('criterios.criterio_g', compact('criterios', 'respuestas'));
    }
    
    // Criterios Oportunidad
    public function criterio_oportunidad($oportunidadCriterio){
        $criterios = Criterio::with([
            'indicadores.preguntas.respuestas' => function ($query) {
                $query->where('user_id', auth()->id());
            }
        ])->where('dimension', $oportunidadCriterio)->get();
        $respuestas = RespuestaOporCriterio::where('user_id', Auth::id())->get();
        return view('criterios.criterio_o', compact('criterios', 'respuestas'));
    }
    

}
