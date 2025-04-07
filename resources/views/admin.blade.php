<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-left: 10px;
            background-color: #f8f9fa;
        }
        h1, h2 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .nav-buttons {
            margin-bottom: 20px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
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
        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .content-area {
        position: relative; /* Añadir posicionamiento relativo */
        top: -20px; /* Ajustar el valor según sea necesario */
        margin-top: 0;
    }
    </style>
</head>
<body>
    <div class="top-right-buttons">
        <a href="{{route('logout')}}"><button class="logout-button">Cerrar Sesión</button></a>
        <a href="{{route('registro-admin')}}"><button class="register-button">Registrar Usuario</button></a>
    </div>

    <h1>Bienvenido, {{ $user->name }}</h1>

    <h2>Descarga de informes por dimensión</h2>
    <div class="nav-buttons">
        <a href="{{ route('dimension.informe', ['dimension' => 'a']) }}"><button>Dimensión A</button></a>
        <a href="{{ route('dimension.informe', ['dimension' => 'b']) }}"><button>Dimensión B</button></a>
        <a href="{{ route('dimension.informe', ['dimension' => 'c']) }}"><button>Dimensión C</button></a>
        <a href="{{ route('dimension.informe', ['dimension' => 'd']) }}"><button>Dimensión D</button></a>
        <a href="{{ route('dimension.informe', ['dimension' => 'e']) }}"><button>Dimensión E</button></a>
    </div>

    <h2>Descarga de informes Identificación de Fortalezas</h2>
    <div class="nav-buttons">
        <a href="{{ route('informe.f', ['dimension' => 'a']) }}"><button>Criterio A</button></a>
        <a href="{{ route('informe.f', ['dimension' => 'b']) }}"><button>Criterio B</button></a>
        <a href="{{ route('informe.f', ['dimension' => 'c']) }}"><button>Criterio C</button></a>
        <a href="{{ route('informe.f', ['dimension' => 'd']) }}"><button>Criterio D</button></a>
        <a href="{{ route('informe.f', ['dimension' => 'e']) }}"><button>Criterio E</button></a>
    </div>

    <h2>Descarga de informes Identificación de Oportunidad</h2>
    <div class="nav-buttons">
        <a href="{{ route('informe.o', ['dimension' => 'a']) }}"><button>Criterio A</button></a>
        <a href="{{ route('informe.o', ['dimension' => 'b']) }}"><button>Criterio B</button></a>
        <a href="{{ route('informe.o', ['dimension' => 'c']) }}"><button>Criterio C</button></a>
        <a href="{{ route('informe.o', ['dimension' => 'd']) }}"><button>Criterio D</button></a>
        <a href="{{ route('informe.o', ['dimension' => 'e']) }}"><button>Criterio E</button></a>
    </div>
    <div class="container">
        <h2>Lista de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Carnet</th>
                    <th>Área</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->area ?? 'No asignada' }}</td>
                        <td>
                            <a href="{{ route('editar-usuario', ['id' => $usuario->id]) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('eliminar-usuario', ['id' => $usuario->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>