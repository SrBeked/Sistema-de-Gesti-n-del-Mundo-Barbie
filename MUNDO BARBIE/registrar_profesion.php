<?php
$archivoProfesiones = 'data/profesiones.json';

$mensaje = '';
$categorias = ["Moda", "Ciencia", "Arte", "Deportes", "Medicina", "Música", "Tecnología", "Educación"];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profesiones = json_decode(file_get_contents($archivoProfesiones), true) ?? [];

    $nuevaProfesion = [
        'id' => time(),
        'nombre' => $_POST['nombre'],
        'categoria' => $_POST['categoria'],
        'salario' => floatval($_POST['salario'])
    ];

    $profesiones[] = $nuevaProfesion;
    file_put_contents($archivoProfesiones, json_encode($profesiones, JSON_PRETTY_PRINT));
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Profesión - Mundo Barbie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffe6f0, #ffd6eb);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #d63384;
        }
        .barbie-title {
            font-size: 2.2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px #ff69b4;
        }
        .form-control {
            border: 2px solid #ff69b4;
            background-color: #fff0f8;
        }
        .btn-barbie {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 10px 25px;
            font-weight: bold;
        }
        .btn-barbie:hover {
            background-color: #e055a1;
        }
        .form-container {
            border: 3px dashed #ff69b4;
            border-radius: 15px;
            background-color: #fff0f8;
            box-shadow: 0 0 10px #ffb6c1;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="barbie-title"> Registrar Nueva Profesión</h1>
        <div class="form-container mx-auto col-md-6">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre de la Profesión:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
               <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria" class="form-select" required>
                <option value="">Seleccionar...</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat ?>"><?= $cat ?></option>
                <?php endforeach; ?>
            </select>
        </div>
                <div class="mb-3">
                    <label class="form-label">Salario ($):</label>
                    <input type="number" step="0.01" name="salario" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-barbie">Guardar Profesión</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center">
        <a href="index.php" class="btn btn-barbie px-5 py-2"> Volver al Inicio</a>
    </div>
</body>
</html>
