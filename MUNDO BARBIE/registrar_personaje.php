<?php
$archivoPersonajes = 'data/personajes.json';
$archivoProfesiones = 'data/profesiones.json';

$profesiones = json_decode(file_get_contents($archivoProfesiones), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $personajes = json_decode(file_get_contents($archivoPersonajes), true) ?? [];

    $nuevoPersonaje = [
    'id' => time(),
    'nombre' => $_POST['nombre'],
    'apellido' => $_POST['apellido'],
    'fecha_nacimiento' => $_POST['fecha_nacimiento'],
    'experiencia' => $_POST['experiencia'],
    'profesion_id' => $_POST['profesion_id'],
    'foto' => $_POST['foto'] ?? ''
];


    $personajes[] = $nuevoPersonaje;
    file_put_contents($archivoPersonajes, json_encode($personajes, JSON_PRETTY_PRINT));
    header('Location: listar_personajes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Personaje - Mundo Barbie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffe6f0, #ffd6eb);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #d63384;
        }
        .barbie-title {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px #ff69b4;
        }
        .form-control {
            border: 2px solid #ff69b4;
        }
        .btn-barbie {
            background-color: #ff69b4;
            color: white;
            border: none;
        }
        .btn-barbie:hover {
            background-color: #e055a1;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="barbie-title"> Registrar Nuevo Personaje</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellido:</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" class="form-control" required>
            </div>

            <div class="mb-3">
            <label class="form-label">Foto (URL)</label>
            <input type="url" name="foto" class="form-control" id="fotoInput" placeholder="https://...">
            <div class="mt-2">
                <img id="previewImage" src="" alt="Vista previa" class="img-thumbnail" style="display:none; max-height: 200px;">
            </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nivel de Experiencia:</label>
                <select name="experiencia" class="form-control" required>
                    <option value="Principiante">Principiante</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Experto">Experto</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Profesión:</label>
                <select name="profesion_id" class="form-control" required>
                    <?php foreach ($profesiones as $profesion): ?>
                        <option value="<?= $profesion['id'] ?>"><?= $profesion['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-barbie">Guardar Personaje</button>
        </form>
    </div>

    <script>
    // Vista previa de la imagen
    const inputFoto = document.getElementById('fotoInput');
    const imgPreview = document.getElementById('previewImage');

    inputFoto.addEventListener('input', () => {
        const url = inputFoto.value;
        if (url) {
            imgPreview.src = url;
            imgPreview.style.display = 'block';
        } else {
            imgPreview.style.display = 'none';
        }
    });
</script>
</body>

<div class="text-center">
        <a href="index.php" class="btn btn-barbie px-5 py-2"> Volver al Inicio</a>
    </div>
</html>
