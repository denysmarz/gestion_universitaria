<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"],
        input[type="email"] {
            width: calc(100% - 22px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .home-button {
            background-color: #28a745;
            margin-top: 20px;
        }
        .home-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Perfil</h2>
        <form action="{{ route('actualizar-perfil') }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="{{ $usuario->name }}" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ $usuario->apellido }}" required>

            <label for="email">Carnet de Identidad:</label>
            <input type="text" id="email" name="email" value="{{ $usuario->email }}" required>

            <button type="submit">Guardar Cambios</button>
        </form>
        <button class="home-button" onclick="window.location.href='{{ url('/home') }}'">Ir a Inicio</button>
    </div>
</body>
</html>