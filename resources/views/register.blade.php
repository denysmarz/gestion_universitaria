<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            font-weight: bold;
            display: block;
        }
        input[type="email"],
        input[type="password"],
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .login-link {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registro</h2>
        <form method="POST" action="{{ route('validar-registro') }}">
            @csrf
            <div class="form-group">
                <label for="email">Carnet de Identidad:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="userInput">Nombre:</label>
                <input type="text" name="name" id="userInput" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" id="apellido" required>
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
        <a href="{{ route('login') }}" class="login-link">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</body>
</html>