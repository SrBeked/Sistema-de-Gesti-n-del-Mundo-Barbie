<?php
$archivoPersonajes = 'data/personajes.json';
$archivoProfesiones = 'data/profesiones.json';

$personajes = json_decode(file_get_contents($archivoPersonajes), true) ?? [];
$profesiones = json_decode(file_get_contents($archivoProfesiones), true) ?? [];

$id = $_GET['id'] ?? null;
if (!$id) { die('ID no especificado'); }

$personaje = null;
foreach ($personajes as $p) {
    if ($p['id'] == $id) {
        $personaje = $p;
        break;
    }
}
if (!$personaje) { die('Personaje no encontrado'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($personajes as &$p) {
        if ($p['id'] == $id) {
            $p['nombre'] = $_POST['nombre'];
            $p['apellido'] = $_POST['apellido'];
            $p['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
            $p['experiencia'] = $_POST['experiencia'];
            $p['profesion_id'] = (int) $_POST['profesion_id'];
            break;
        }
    }
    file_put_contents($archivoPersonajes, json_encode($personajes, JSON_PRETTY_PRINT));
    header('Location: listar_personajes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> Editar Personaje Barbie </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffc0cb, #ffb6c1);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #880e4f;
        }
        .container {
            background-color: #fff0f5;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.5);
        }
        h1 {
            color: #e91e63;
            font-weight: bold;
            text-align: center;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #e91e63;
            border-color: #e91e63;
        }
        .btn-primary:hover {
            background-color: #c2185b;
        }
        .btn-secondary {
            background-color: #f8bbd0;
            color: #880e4f;
            border-color: #f8bbd0;
        }
        .btn-secondary:hover {
            background-color: #f48fb1;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1> Editar Personaje Barbie </h1>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($personaje['nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido:</label>
            <input type="text" name="apellido" class="form-control" value="<?= htmlspecialchars($personaje['apellido']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="<?= htmlspecialchars($personaje['fecha_nacimiento']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nivel de experiencia:</label>
            <select name="experiencia" class="form-select">
                <option <?= $personaje['experiencia'] == 'Principiante' ? 'selected' : '' ?>>Principiante</option>
                <option <?= $personaje['experiencia'] == 'Intermedio' ? 'selected' : '' ?>>Intermedio</option>
                <option <?= $personaje['experiencia'] == 'Avanzado' ? 'selected' : '' ?>>Avanzado</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Profesión:</label>
            <select name="profesion_id" class="form-select">
                <?php foreach ($profesiones as $prof): ?>
                    <option value="<?= $prof['id'] ?>" <?= $personaje['profesion_id'] == $prof['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prof['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="d-grid gap-2 d-md-block">
            <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
            <a href="listar_personajes.php" class="btn btn-secondary"> Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
