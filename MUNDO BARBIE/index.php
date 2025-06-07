<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Mundo Barbie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffe6f0, #ffd6eb);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #d63384;
        }
        .barbie-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px #ff69b4;
        }
        .list-group-item {
            background-color: #fff0f5;
            border: none;
            border-left: 5px solid #ff69b4;
            transition: 0.3s;
        }
        .list-group-item:hover {
            background-color: #ffe0f0;
            color: #d63384;
            font-weight: bold;
        }
        .card-style {
            border: 3px dashed #ff69b4;
            border-radius: 15px;
            background-color: #fff0f8;
            box-shadow: 0 0 10px #ffb6c1;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="barbie-title"> Sistema de Gestión del Mundo Barbie </h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 card-style p-4">
                <div class="list-group">
                    <a href="registrar_personaje.php" class="list-group-item list-group-item-action">
                         Registrar Personaje
                    </a>
                    <a href="listar_personajes.php" class="list-group-item list-group-item-action">
                         Lista de Personajes y Profesiones
                    </a>
                    <a href="registrar_profesion.php" class="list-group-item list-group-item-action">
                         Registrar Profesión
                    </a>
                    <a href="dashboard.php" class="list-group-item list-group-item-action">
                         Estadísticas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
