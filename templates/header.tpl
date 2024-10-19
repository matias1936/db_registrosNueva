<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <base href="{$BASE_URL}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro de Asistencia</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand text-white fw-bold" href="listar">Registro de Asistencia</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="listar">Registros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="listar_establecimientos">Establecimientos</a>
                        </li>
                        {if $user}
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{$BASE_URL}logout">Salir</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link text-white">Bienvenido, {$user->usuario|escape}</span>
                            </li>
                        {/if}
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-3">
