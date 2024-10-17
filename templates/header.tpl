<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{$BASE_URL}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro de Asistencia</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand text-white fw-bold" href="{$BASE_URL}">Registro de Asistencia</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="{$BASE_URL}">Registros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="{$BASE_URL}establecimientos">Establecimientos</a>
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
    <!-- Your content here -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2JDzWzaJKf29Z4CxO5bFm7FQ3rjP20Haa6g7ksEJ5b/0AA11p2VkkxKhniI" crossorigin="anonymous"></script>
</body>
</html>
