<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 25px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="email"],
        input[type="password"],
        input[type="text"],
        select {
            width: calc(100% - 22px);
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 14px 20px;
            border: none;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .home-button {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-bottom: 25px;
        }
        .home-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <a href="{{ url('/admin') }}" class="home-button">Ir a Inicio</a>

    <div class="register-container">
        <h2>Registro de Usuario</h2>
        <form id="registerForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Carnet de Identidad:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="name">Nombre Completo:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="area">Área (opcional):</label>
                <select name="area" id="area">
                    <option value="">Seleccione su área</option>
                    <option value="planificacion y evaluacion institucional">Planificación y Evaluación Institucional</option>
                    <option value="planificacion academica">Planificación Académica</option>
                    <option value="ejecutivo CEPI">Ejecutivo CEPI</option>
                    <option value="DICYT">DICYT</option>
                    <option value="DISEU">DISEU</option>
                    <option value="Relaciones internacionales">Relaciones Internacionales</option>
                    <option value="Director administrativo y financiero">Director Administrativo y Financiero</option>
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="Bienestar universitario">Bienestar Universitario</option>
                    <option value="DTIC">DTIC</option>
                    <option value="Departamento de Infraestructura">Departamento de Infraestructura</option>
                </select>
            </div>
            <button type="submit" class="btn">Registrarse</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("registerForm").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                fetch("{{ route('validar-admin') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    document.getElementById("registerForm").reset();
                })
                .catch(error => console.error("Error:", error));
            });
        });
    </script>
</body>
</html>