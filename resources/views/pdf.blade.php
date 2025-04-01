<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Respuestas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        table {
            width: 100%;
            table-layout: fixed;
            word-wrap: break-word;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            padding-left: 10px;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            padding-left: 5px;
            color: #555;
            font-size: 14px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 5px;
        }

        p {
            color: #555;
            font-size: 14px;
        }

        ul {
            padding-left: 20px;
        }

        .pregunta-container {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <h1>Gestion Universitaria</h1>

    @foreach($criterios as $criterio)
    <h3>Criterio</h3>
    <h3>{{ $criterio->nombre }}</h3>
    <p>{{ $criterio->descripcion }}</p>

    <ul>
        @foreach($criterio->indicadores as $indicador)
            <h3>Indicador</h3>
            <li>
                <strong>{{ $indicador->nombre }}</strong>
                <p>{{ $indicador->descripcion }}</p>

                <!-- Contenedor de preguntas -->
                <ul class="pregunta-lista" id="pregunta-lista-{{ $indicador->id }}">
                    @foreach($indicador->preguntas as $pregunta)
                        <div class="pregunta-container" data-id="{{ $pregunta->id }}">
                            <h4>Pregunta:</h4>
                            <p>{{ $pregunta->pregunta }}</p>

                            <!-- Tabla con respuestas de los usuarios -->
                            <table>
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Responsable</th>
                                        <th>Instancias académicas/administrativas que coadyuvan</th>
                                        <th>Documentos a consultar</th>
                                        <th>¿El documento existe?</th>
                                        <th>Si no existe, ¿Quién debe elaborar?</th>
                                        <th>Información complementaria</th>
                                        <th>Desarrollo de la respuesta</th>
                                        <th>Evidencias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pregunta->respuestas as $respuesta)
                                        <tr>
                                            <td>{{ $respuesta->usuario->name ?? 'Usuario desconocido' }}</td>
                                            <td>{{ $respuesta->responsable ?? 'Sin responsable' }}</td>
                                            <td>{{ $respuesta->instancia ?? 'Sin instancia' }}</td>
                                            <td>{{ $respuesta->documentos ?? 'Sin documentos' }}</td>
                                            <td>{{ $respuesta->existe ?? 'No especificado' }}</td>
                                            <td>{{ $respuesta->quien_elabora ?? 'No especificado' }}</td>
                                            <td>{{ $respuesta->info_complementaria ?? 'Sin información complementaria' }}</td>
                                            <td>{{ $respuesta->respuesta ?? 'Sin respuesta' }}</td>
                                            <td>{{ $respuesta->evidencias ?? 'Sin evidencias' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endforeach

</body>
</html>
