<?php

namespace App\Http\Controllers;
use App\Models\Respuesta;
use App\Models\RespuestaForCriterio;
use App\Models\RespuestaOporCriterio;
use App\Models\Criterio;
use Illuminate\Http\Request;
use PDF;
class PDFController extends Controller
{
    public function GenerarPDFFA($dimension)
    {
        // Obtener criterios donde la dimensión sea la especificada junto con sus respuestas
        $criterios = Criterio::with('respuestasForCriterios.usuario')
                            ->where('dimension', $dimension)
                            ->get();

        // Generar el nombre del archivo PDF dinámicamente
        $nombreArchivo = 'Criterio_f_' . strtoupper($dimension) . '.pdf';

        // Generar el PDF con la vista correspondiente
        $pdf = Pdf::loadView('informes.criterio_f_a', compact('criterios'))
                    ->setPaper('a4', 'landscape')
                    ->set_option('isHtml5ParserEnabled', true)
                    ->set_option('isPhpEnabled', true);

        return $pdf->stream($nombreArchivo);
    }
    public function GenerarPDFOA($dimension)
    {
        // Obtener criterios donde la dimensión sea la especificada junto con sus respuestas
        $criterios = Criterio::with('respuestasOporCriterios.usuario')
                            ->where('dimension', $dimension)
                            ->get();

        // Generar el nombre del archivo PDF dinámicamente
        $nombreArchivo = 'Criterio_o_' . strtoupper($dimension) . '.pdf';

        // Generar el PDF con la vista correspondiente
        $pdf = Pdf::loadView('informes.criterio_o_a', compact('criterios'))
                    ->setPaper('a4', 'landscape')
                    ->set_option('isHtml5ParserEnabled', true)
                    ->set_option('isPhpEnabled', true);

        return $pdf->stream($nombreArchivo);
    }

    
    public function GenerarPDFDimension($dimension) {
        $respuestas = Respuesta::with(['criterio', 'indicador', 'pregunta', 'usuario'])->get();
    
        // Filtrar criterios donde la dimensión sea 'a'
        $criterios = Criterio::with(['indicadores.preguntas'])
                             ->where('dimension', $dimension)
                             ->get();

        // Generar el nombre del archivo PDF dinámicamente
        $nombreArchivo = 'Dimension ' . strtoupper($dimension) . '.pdf';

        // Generar el PDF con la vista correspondiente
        $pdf = Pdf::loadView('informes.dimension_a', compact('criterios'))
                    ->setPaper('a4', 'landscape')
                    ->set_option('isHtml5ParserEnabled', true)
                    ->set_option('isPhpEnabled', true);

        return $pdf->stream($nombreArchivo);


    }

}
