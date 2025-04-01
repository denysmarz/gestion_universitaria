<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f7f9;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-container {
            width: 90%;
            max-width: 600px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"],
        input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .nav-buttons {
            margin-top:20px;
            text-align: center;
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
        .logout-button {
            background-color: #dc3545;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
        .register-button{
            background-color: #28a745;
        }
        .register-button:hover{
            background-color: #218838;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Editar Usuario</h1>
        <form action="{{ route('actualizar-usuario', ['id' => $usuario->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="{{ $usuario->name }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $usuario->email }}" required>

            <label for="area">Área:</label>
            <input type="text" id="area" name="area" value="{{ $usuario->area }}">

            <button type="submit">Actualizar Usuario</button>
        </form>
    </div>
    <div class="nav-buttons">
        <button onclick="window.location.href='{{ url('/admin') }}'">Ir a Inicio</button>
        <a href="{{route('logout')}}"><button class="logout-button">Cerrar Sesión</button></a>
    </div>
</body>
</html>