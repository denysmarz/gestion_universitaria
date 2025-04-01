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
    <h1>Identificación de fortalezas</h1>
        @if(count($criterios) > 0)
            <h1>Criterio {{ strtoupper($criterios->first()->dimension) }}</h1>
        @else
            <h1>Criterio Desconocido</h1>
        @endif
    @foreach($criterios as $criterio)
        <h3>{{ $criterio->nombre }}</h3>
        <p>{{ $criterio->descripcion }}</p>

        <!-- Tabla con respuestas de los usuarios -->
        <table border="1">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Problemática</th>
                    <th>Estrategia</th>
                    <th>Mecanismo</th>
                    <th>Acción</th>
                    <th>Responsable</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($criterio->respuestasForCriterios as $respuesta)
                    <tr>
                        <td>{{ $respuesta->usuario->name ?? 'Usuario desconocido' }}</td>
                        <td>{{ $respuesta->problematica ?? 'Sin información' }}</td>
                        <td>{{ $respuesta->estrategia ?? 'Sin información' }}</td>
                        <td>{{ $respuesta->mecanismo ?? 'Sin información' }}</td>
                        <td>{{ $respuesta->accion ?? 'Sin información' }}</td>
                        <td>{{ $respuesta->responsable ?? 'No asignado' }}</td>
                        <td>{{ $respuesta->fecha_p ?? 'Sin fecha' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>
