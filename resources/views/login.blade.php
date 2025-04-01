<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 30px;
            color: #2193b0;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #2193b0;
            outline: none;
        }
        .remember {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        input[type="checkbox"] {
            margin-right: 8px;
        }
        .btn {
            background-color: #2193b0;
            color: white;
            padding: 14px 20px;
            border: none;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #1a7e96;
        }
        .register-btn {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2193b0;
            font-weight: 600;
        }
        .register-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('inicia-sesion') }}">
            @csrf
            <div class="form-group">
                <label for="email">Carnet de Identidad:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Mantener sesión iniciada</label>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
        <a href="{{ route('registro') }}" class="register-btn">Registrarse</a>
    </div>
</body>
</html>