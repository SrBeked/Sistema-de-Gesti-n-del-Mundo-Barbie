<?php
$archivoPersonajes = 'data/personajes.json';
$archivoProfesiones = 'data/profesiones.json';

$personajes = json_decode(file_get_contents($archivoPersonajes), true) ?? [];
$profesiones = json_decode(file_get_contents($archivoProfesiones), true) ?? [];

$mapaProfesiones = [];
foreach ($profesiones as $p) {
    $mapaProfesiones[$p['id']] = $p['nombre'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Personajes - Mundo Barbie</title>
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
        .table {
            background-color: #fff0f8;
        }
        .table th {
            background-color: #ff69b4;
            color: white;
        }
        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="barbie-title"> Lista de Personajes </h1>
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre Completo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Experiencia</th>
                    <th>Profesión</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($personajes as $p): ?>
                    <tr>
                        <td>
                            <?php if (!empty($p['foto'])): ?>
                                <img src="<?= htmlspecialchars($p['foto']) ?>" alt="Foto" class="img-thumbnail">
                            <?php else: ?>
                                <span>Sin Foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?></td>
                        <td><?= htmlspecialchars($p['fecha_nacimiento']) ?></td>
                        <td><?= htmlspecialchars($p['experiencia']) ?></td>
                        <td><?= htmlspecialchars($mapaProfesiones[$p['profesion_id']] ?? 'N/A') ?></td>
                        <td>
                            <a href="editar_personaje.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar_personaje.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este personaje?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-pink btn-lg" style="border-color:#ff69b4;color:#ff69b4;">⟵ Volver al Inicio</a>
        </div>
    </div>
</body>
</html>
