<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-left: 10px;
            background-color: #f8f9fa;
        }
        h1, h2 {
            color: #343a40;
            margin-bottom: 15px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .section {
            margin-bottom: 30px;
            padding: 15px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logout-button {
            background-color: #dc3545;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .content-area {
            margin-top: 0;
        }
        .edit-profile-button {
            background-color: #28a745; /* Verde para el botón de editar */
        }
        .edit-profile-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="top-right-buttons">
        <a href="{{ route('editar-perfil') }}"><button class="edit-profile-button">Editar Datos</button></a>
        <a href="{{route('logout')}}"><button class="logout-button">Cerrar Sesión</button></a>
    </div>

    <div class="content-area">
        <h1>Bienvenido, {{ $user->name }}</h1>

        <div class="section">
            <h2>Informes por Dimensión</h2>
            <a href="{{ route('dimension.a', ['dimension' => 'a']) }}"><button>Dimensión A</button></a>
            <a href="{{ route('dimension.a', ['dimension' => 'b']) }}"><button>Dimensión B</button></a>
            <a href="{{ route('dimension.a', ['dimension' => 'c']) }}"><button>Dimensión C</button></a>
            <a href="{{ route('dimension.a', ['dimension' => 'd']) }}"><button>Dimensión D</button></a>
            <a href="{{ route('dimension.a', ['dimension' => 'e']) }}"><button>Dimensión E</button></a>
        </div>

        <div class="section">
            <h2>Identificación de Fortalezas</h2>
            <a href="{{ route('fortalezas.criterio', ['criterio' => 'a']) }}"><button>Criterio A</button></a>
            <a href="{{ route('fortalezas.criterio', ['criterio' => 'b']) }}"><button>Criterio B</button></a>
            <a href="{{ route('fortalezas.criterio', ['criterio' => 'c']) }}"><button>Criterio C</button></a>
            <a href="{{ route('fortalezas.criterio', ['criterio' => 'd']) }}"><button>Criterio D</button></a>
            <a href="{{ route('fortalezas.criterio', ['criterio' => 'e']) }}"><button>Criterio E</button></a>
        </div>

        <div class="section">
            <h2>Identificación de Áreas de Oportunidad / Plan de Fortalecimiento</h2>
            <a href="{{ route('oportunidades.criterio', ['oportunidadCriterio' => 'a']) }}"><button>Plan A</button></a>
            <a href="{{ route('oportunidades.criterio', ['oportunidadCriterio' => 'b']) }}"><button>Plan B</button></a>
            <a href="{{ route('oportunidades.criterio', ['oportunidadCriterio' => 'c']) }}"><button>Plan C</button></a>
            <a href="{{ route('oportunidades.criterio', ['oportunidadCriterio' => 'd']) }}"><button>Plan D</button></a>
            <a href="{{ route('oportunidades.criterio', ['oportunidadCriterio' => 'e']) }}"><button>Plan E</button></a>
        </div>
    </div>

</body>
</html>