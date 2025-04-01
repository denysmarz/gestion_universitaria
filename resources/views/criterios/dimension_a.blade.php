<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Criterios dimensión A</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f7f9;
            color: #333;
            line-height: 1.6;
        }
        h2, h3, h4 {
            color: #007bff;
            margin-bottom: 10px;
        }
        h2 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        h3 {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #555;
        }
        textarea, input, select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .pregunta-container {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .pregunta-lista {
            display: none;
            list-style-type: none;
            padding-left: 0;
        }
        .formulario-adicional {
            display: none;
            padding: 15px;
            background: #f8f8f8;
            border-radius: 8px;
            margin-top: 10px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 20px;
        }
        input[type="checkbox"] {
            width: auto;
            margin-right: 5px;
        }
        .instancias-container {
            margin-top: 5px;
            padding-left: 15px;
        }
        .nav-buttons {
            margin-bottom: 20px;
        }
        .nav-buttons button, .nav-buttons a button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 15px;
            cursor: pointer;
            margin: 0 10px;
            transition: background-color 0.3s;
        }
        .nav-buttons button:hover, .nav-buttons a button:hover {
            background-color: #0056b3;
        }
        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .logout-button {
            background-color: #dc3545;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<button onclick="window.location.href='{{ url('/home') }}'">Ir a Inicio</button>
<div class="top-right-buttons">
    <a href="{{route('logout')}}"><button class="logout-button">Cerrar Sesión</button></a>
</div>

<h2>Lista de Criterios, Indicadores y Preguntas</h2>

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

                <!-- Botón para mostrar/ocultar preguntas -->
                <button type="button" onclick="togglePreguntas({{ $indicador->id }})">Mostrar/Ocultar Preguntas</button>

                <!-- Contenedor de preguntas -->
                <ul class="pregunta-lista" id="pregunta-lista-{{ $indicador->id }}">
                    @foreach($indicador->preguntas as $pregunta)
                        <div class="pregunta-container" data-id="{{ $pregunta->id }}" data-respuesta-id="{{ optional($pregunta->respuestas->first())->id }}">
                            <h4>Pregunta:</h4>
                            <p>{{ $pregunta->pregunta }}</p>

                            <!-- Botón para mostrar/ocultar campos -->
                            <button type="button" onclick="toggleForm({{ $pregunta->id }})">Mostrar/ocultar campos</button>

                            <!-- Campos del formulario -->
                            <form class="formulario-adicional" id="formulario-{{ $pregunta->id }}" onsubmit="guardarPregunta(event, {{ $criterio->id }}, {{ $indicador->id }}, {{ $pregunta->id }})">
                                @csrf
                                <input type="hidden" name="respuesta_id" id="respuesta-id-{{ $pregunta->id }}" value="{{ optional($pregunta->respuestas->first())->id }}"> 

                                <div class="form-group">
                                    <label>Responsable:</label>
                                    <input type="text" name="responsable" value="{{ $usuario->area ?? 'Sin área asignada' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Instancias académicas/administrativas que coadyuvan:</label>
                                    <div>
                                        @php
                                            $instanciasSeleccionadas = explode(',', optional($pregunta->respuestas->first())->instancia);
                                        @endphp
                                        <label><input type="checkbox" name="instancia[]" value="DPEI" {{ in_array('DPEI', $instanciasSeleccionadas) ? 'checked' : '' }}> DPEI</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="planificacion academica" {{ in_array('planificacion academica', $instanciasSeleccionadas) ? 'checked' : '' }}> Planificación académica</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="CEPI" {{ in_array('CEPI', $instanciasSeleccionadas) ? 'checked' : '' }}> CEPI</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="DICYT" {{ in_array('DICYT', $instanciasSeleccionadas) ? 'checked' : '' }}> DICYT</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="DISEU" {{ in_array('DISEU', $instanciasSeleccionadas) ? 'checked' : '' }}> DISEU</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="Relaciones Internacionales" {{ in_array('Relaciones Internacionales', $instanciasSeleccionadas) ? 'checked' : '' }}> Relaciones Internacionales</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="Administrativo y financiero" {{ in_array('Administrativo y financiero', $instanciasSeleccionadas) ? 'checked' : '' }}> Administrativo y financiero</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="Recursus Humanos" {{ in_array('Recursus Humanos', $instanciasSeleccionadas) ? 'checked' : '' }}> Recursos Humanos</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="Bienestar Universitario" {{ in_array('Bienestar Universitario', $instanciasSeleccionadas) ? 'checked' : '' }}> Bienestar Universitario</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="DTIC" {{ in_array('DTIC', $instanciasSeleccionadas) ? 'checked' : '' }}> DTIC</label><br>
                                        <label><input type="checkbox" name="instancia[]" value="Departamento Infraestructura" {{ in_array('Departamento Infraestructura', $instanciasSeleccionadas) ? 'checked' : '' }}> Departamento Infraestructura</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Documentos a consultar:</label>
                                    <textarea name="documentos">{{ optional($pregunta->respuestas->first())->documentos }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>¿El documento existe?</label>
                                    <select name="existe">
                                        <option value="SI" {{ optional($pregunta->respuestas->first())->existe == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ optional($pregunta->respuestas->first())->existe == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Si no existe, ¿Quién debe elaborar?</label>
                                    <input type="text" name="quien_elabora" value="{{ optional($pregunta->respuestas->first())->quien_elabora }}">
                                </div>
                                <div class="form-group">
                                    <label>Información complementaria:</label>
                                    <textarea name="info_complementaria">{{ optional($pregunta->respuestas->first())->info_complementaria }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Desarrollo de la respuesta:</label>
                                    <textarea name="respuesta">{{ optional($pregunta->respuestas->first())->respuesta }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Evidencias:</label>
                                    <textarea name="evidencias">{{ optional($pregunta->respuestas->first())->evidencias }}</textarea>
                                </div>
                                <button type="submit">Guardar</button>
                            </form>
                        </div>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endforeach

<script>
    function togglePreguntas(indicadorId) {
        const preguntaLista = document.getElementById(`pregunta-lista-${indicadorId}`);
        preguntaLista.style.display = (preguntaLista.style.display === "none" || preguntaLista.style.display === "") ? "block" : "none";
    }

    function toggleForm(preguntaId) {
        const formulario = document.getElementById(`formulario-${preguntaId}`);
        formulario.style.display = formulario.style.display === "none" ? "block" : "none";
    }

    function guardarPregunta(event, criterioId, indicadorId, preguntaId) {
        event.preventDefault();

        let form = event.target;
        let formData = new FormData(form);

        formData.append('criterio_id', criterioId);
        formData.append('indicador_id', indicadorId);
        formData.append('pregunta_id', preguntaId);

        fetch("/obtener-usuario")
            .then(response => response.json())
            .then(data => {
                formData.append('user_id', data.user_id);

                return fetch("/guardar-respuesta", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Respuesta guardada correctamente.");
                } else {
                    alert("Error al guardar la respuesta.");
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>
