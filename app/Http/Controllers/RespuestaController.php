<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use App\Models\RespuestaForCriterio;
use App\Models\RespuestaOporCriterio;
use App\Models\Criterio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class RespuestaController extends Controller
{

    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'criterio_id' => 'required|exists:criterios,id',
            'indicador_id' => 'required|exists:indicadores,id',
            'pregunta_id' => 'required|exists:preguntas,id',
            'responsable' => 'required|string',
            'instancia' => 'nullable|array', // Aceptar como array
            'instancia.*' => 'string', // Cada valor dentro del array debe ser un string
            'documentos' => 'nullable|string',
            'existe' => 'required|in:SI,NO',
            'quien_elabora' => 'nullable|string',
            'info_complementaria' => 'nullable|string',
            'respuesta' => 'nullable|string',
            'evidencias' => 'nullable|string',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Convertir el array de instancias en una cadena separada por comas
        $instanciaString = $request->has('instancia') ? implode(',', $request->instancia) : null;

        // Verificar si la respuesta ya existe
        $respuesta = Respuesta::where('criterio_id', $request->criterio_id)
                            ->where('indicador_id', $request->indicador_id)
                            ->where('pregunta_id', $request->pregunta_id)
                            ->where('user_id', $userId)
                            ->first();

        if ($respuesta) {
            // Si la respuesta existe, actualizamos los campos
            $respuesta->update($request->except('instancia') + ['instancia' => $instanciaString, 'user_id' => $userId]);
            return response()->json(['success' => true, 'message' => 'Respuesta actualizada correctamente.']);
        } else {
            // Si no existe, se crea una nueva respuesta
            Respuesta::create($request->except('instancia') + ['instancia' => $instanciaString, 'user_id' => $userId]);
            return response()->json(['success' => true, 'message' => 'Respuesta guardada correctamente.']);
        }
    }


    public function store_criterio(Request $request)
    {   
        // Validar los datos recibidos
        $request->validate([
            'criterio_id' => 'required|exists:criterios,id',
            'problematica' => 'nullable|string',
            'estrategia' => 'nullable|string',
            'mecanismo' => 'nullable|string',
            'accion' => 'nullable|string',
            'responsable' => 'required|string',
            'fecha_p' => 'nullable|string',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Verificar si el request incluye un ID (actualización) o no (nueva respuesta)
        if ($request->has('id') && !empty($request->id)) {
            // Si existe un ID, actualizamos la respuesta existente
            $respuesta = RespuestaForCriterio::where('id', $request->id)
                            ->where('user_id', $userId)
                            ->first();

            if ($respuesta) {
                $respuesta->update($request->except('id') + ['user_id' => $userId]);
                return response()->json(['success' => true, 'message' => 'Respuesta actualizada correctamente.']);
            }
        }

        // Si no hay ID, creamos una nueva respuesta
        $nuevaRespuesta = RespuestaForCriterio::create($request->all() + ['user_id' => $userId]);

        return response()->json(['success' => true, 'message' => 'Respuesta guardada correctamente.', 'id' => $nuevaRespuesta->id]);
    }



    public function store_criterio_o(Request $request)
    {   
        $request->validate([
            'criterio_id' => 'required|exists:criterios,id',
            'problematica' => 'nullable|string',
            'estrategia' => 'nullable|string',
            'mecanismo' => 'nullable|string',
            'accion' => 'nullable|string',
            'responsable' => 'required|string',
            'fecha_p' => 'nullable|string',
        ]);
        $userId = Auth::id();
        if ($request->has('id') && !empty($request->id)) {
            $respuesta = RespuestaOporCriterio::where('id', $request->id)
                            ->where('user_id', $userId)
                            ->first();
            if ($respuesta) {
                $respuesta->update($request->except('id') + ['user_id' => $userId]);
                return response()->json(['success' => true, 'message' => 'Respuesta actualizada correctamente.']);
            }
        }
        $nuevaRespuesta = RespuestaOporCriterio::create($request->all() + ['user_id' => $userId]);
        return response()->json(['success' => true, 'message' => 'Respuesta guardada correctamente.', 'id' => $nuevaRespuesta->id]);
    }


    public function destroy($id) {
        $respuesta = RespuestaForCriterio::find($id);
        
        if (!$respuesta) {
            return response()->json(["success" => false, "message" => "No se encontró la respuesta"]);
        }
    
        $respuesta->delete();
        return response()->json(["success" => true, "message" => "Respuesta eliminada correctamente"]);
    }
    public function destroy_o($id) {
        $respuesta = RespuestaOporCriterio::find($id);
        
        if (!$respuesta) {
            return response()->json(["success" => false, "message" => "No se encontró la respuesta"]);
        }
    
        $respuesta->delete();
        return response()->json(["success" => true, "message" => "Respuesta eliminada correctamente"]);
    }
    
}
