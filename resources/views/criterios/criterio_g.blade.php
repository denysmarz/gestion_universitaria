<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Criterios</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            text-align: center;
            background-color: #f4f7f9;
            padding-top: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        input {
            width: 100%;
            border: none;
            outline: none;
            padding: 4px;
            box-sizing: border-box;
            text-align: center;
            display: block;
        }
        button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color:rgb(2, 107, 219);
        }
        .delete-btn {
            background-color: #dc3545;
            padding: 8px 12px;
            cursor: pointer;
            color: white;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .nav-buttons {
            margin-bottom: 20px;
        }
        .nav-buttons button, .nav-buttons a button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            margin: 0 10px;
            transition: background-color 0.3s;
        }
        .nav-buttons button:hover, .nav-buttons a button:hover {
            background-color: #0056b3;
        }
        .guardar-respuesta {
            background-color: #28a745;
        }
        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;       
        }
        .top-left-buttons {
            position: absolute;
            top: 20px;
            left: 20px;
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

<div class="top-left-buttons">
        <button onclick="window.location.href='{{ url('/home') }}'">Ir a Inicio</button>
    </div>

<div class="top-right-buttons">
    <a href="{{route('logout')}}"><button class="logout-button">Cerrar Sesión</button></a>
</div>

<h2>Identificación de fortalezas</h2>

@foreach($criterios as $criterio)
    <h3>Criterio</h3>
    <h3>{{ $criterio->nombre }}</h3>
    <form onsubmit="event.preventDefault();">
        <table>
            <thead>
                <tr>
                    <th>Problemática</th>
                    <th>Estrategia</th>
                    <th>Mecanismo</th>
                    <th>Acción</th>
                    <th>Responsable</th>
                    <th>Fecha</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $respuestas_usuario = $respuestas->where('criterio_id', $criterio->id);
                @endphp

                @foreach($respuestas_usuario as $respuesta)
<tr data-id="{{ $respuesta->id }}">
    <td><input type="text" name="problematica" value="{{ $respuesta->problematica }}"></td>
    <td><input type="text" name="estrategia" value="{{ $respuesta->estrategia }}"></td>
    <td><input type="text" name="mecanismo" value="{{ $respuesta->mecanismo }}"></td>
    <td><input type="text" name="accion" value="{{ $respuesta->accion }}"></td>
    <td><input type="text" name="responsable" value="{{ $respuesta->responsable }}"></td>
    <td><input type="date" name="fecha_p" value="{{ $respuesta->fecha_p }}"></td>
    <td>
        <button type="button" class="guardar-respuesta" onclick="guardarRespuesta(this.closest('tr'))">Guardar</button>
        <button type="button" class="delete-btn" onclick="eliminarRespuesta(this.closest('tr'))">Eliminar</button>
    </td>
</tr>
@endforeach
            </tbody>
        </table>
        <input type="hidden" name="criterio_id" value="{{ $criterio->id }}">
    </form>

    <button onclick="agregarFila(this)">Agregar Fila</button>
@endforeach

<script>
    function agregarFila(boton) {
        const tabla = boton.previousElementSibling; // Encuentra la tabla antes del botón
        const tbody = tabla.getElementsByTagName('tbody')[0];
        const nuevaFila = tbody.insertRow();

        // NO ASIGNAMOS data-id porque es una nueva fila
        nuevaFila.removeAttribute("data-id");

        let campos = ["problematica", "estrategia", "mecanismo", "accion", "responsable", "fecha_p"];
        campos.forEach((campo, i) => {
            let celda = nuevaFila.insertCell(i);
            let input = document.createElement("input");
            input.type = campo === "fecha_p" ? "date" : "text";
            input.name = campo;
            celda.appendChild(input);
        });

        // Agregar botón de operaciones (Guardar y Eliminar)
        let celdaOperacion = nuevaFila.insertCell(campos.length);
        let btnGuardar = document.createElement("button");
        btnGuardar.innerText = "Guardar";
        btnGuardar.classList.add("guardar-btn");
        btnGuardar.onclick = function () {
            guardarRespuesta(nuevaFila);
        };

        let btnEliminar = document.createElement("button");
        btnEliminar.innerText = "Eliminar";
        btnEliminar.classList.add("delete-btn");
        btnEliminar.onclick = function () {
            nuevaFila.remove();
        };

        celdaOperacion.appendChild(btnGuardar);
        celdaOperacion.appendChild(btnEliminar);
    }


    function guardarRespuesta(row) {
        console.log("Función guardarRespuesta invocada");
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        let formData = new FormData();
        formData.append("_token", csrfToken);
        formData.append("criterio_id", row.closest("form").querySelector("[name='criterio_id']").value);
        formData.append("problematica", row.querySelector("[name='problematica']").value);
        formData.append("estrategia", row.querySelector("[name='estrategia']").value);
        formData.append("mecanismo", row.querySelector("[name='mecanismo']").value);
        formData.append("accion", row.querySelector("[name='accion']").value);
        formData.append("responsable", row.querySelector("[name='responsable']").value);
        formData.append("fecha_p", row.querySelector("[name='fecha_p']").value);

        // Si la fila ya tiene un ID, lo enviamos para actualizar
        let id = row.getAttribute("data-id");
        if (id) {
            formData.append("id", id);
        }

        console.log("Datos que se enviarán:", Object.fromEntries(formData));

        fetch("/guardar-criterio-f", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            alert(data.message);
            // Si se creó un nuevo registro, asignamos el ID a la fila
            if (data.id) {
                row.setAttribute("data-id", data.id);
            }
            
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error: " + (error.message || "Hubo un problema al guardar."));
        });
    }
    
    function eliminarRespuesta(row) {
        let id = row.getAttribute("data-id");

        if (!id) {
            alert("No se encontró el ID de la respuesta.");
            return;
        }

        if (!confirm("¿Seguro que quieres eliminar esta respuesta?")) {
            return;
        }

        fetch(`/eliminar-respuesta/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Content-Type": "application/json",
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                row.remove();
            } else {
                alert("Error al eliminar la respuesta.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un error al comunicarse con el servidor.");
        });
    }



</script>

</body>
</html>
