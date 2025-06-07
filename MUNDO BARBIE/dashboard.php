<?php
$archivoPersonajes = 'data/personajes.json';
$archivoProfesiones = 'data/profesiones.json';

$personajes = json_decode(file_get_contents($archivoPersonajes), true) ?? [];
$profesiones = json_decode(file_get_contents($archivoProfesiones), true) ?? [];

$totalPersonajes = count($personajes);
$totalProfesiones = count($profesiones);

// Contar personajes por experiencia
$experienciaStats = [
    'Principiante' => 0,
    'Intermedio' => 0,
    'Avanzado' => 0
];

// Contar profesiones utilizadas
$usoProfesiones = [];

foreach ($personajes as $p) {
    $experienciaStats[$p['experiencia']]++;

    if (!isset($usoProfesiones[$p['profesion_id']])) {
        $usoProfesiones[$p['profesion_id']] = 0;
    }
    $usoProfesiones[$p['profesion_id']]++;
}

// Ordenar profesiones más utilizadas
arsort($usoProfesiones);

// Mapa ID => Profesión
$mapaProfesiones = [];
foreach ($profesiones as $prof) {
    $mapaProfesiones[$prof['id']] = $prof;
}

// Edad promedio
$totalEdad = array_sum(array_column($personajes, 'edad'));
$edadPromedio = $totalPersonajes > 0 ? $totalEdad / $totalPersonajes : 0;

// Distribución por categoría de profesión
$distribucionCategorias = [];
foreach ($personajes as $p) {
    $cat = $mapaProfesiones[$p['profesion_id']]['categoria'] ?? 'Desconocida';
    $distribucionCategorias[$cat] = ($distribucionCategorias[$cat] ?? 0) + 1;
}

// Profesión con salario mayor y menor
$salarioMax = null;
$salarioMin = null;
$profesionSalarioMax = '';
$profesionSalarioMin = '';

foreach ($profesiones as $profesion) {
    $salario = $profesion['salario'];
    if ($salarioMax === null || $salario > $salarioMax) {
        $salarioMax = $salario;
        $profesionSalarioMax = $profesion['nombre'];
    }
    if ($salarioMin === null || $salario < $salarioMin) {
        $salarioMin = $salario;
        $profesionSalarioMin = $profesion['nombre'];
    }
}

// Salario promedio
$totalSalarios = array_sum(array_column($profesiones, 'salario'));
$salarioPromedio = $totalProfesiones > 0 ? $totalSalarios / $totalProfesiones : 0;

// Personaje con salario más alto
$personajeSalarioMax = '';
$salarioPersonajeMax = 0;
foreach ($personajes as $p) {
    $salario = $mapaProfesiones[$p['profesion_id']]['salario'] ?? 0;
    if ($salario > $salarioPersonajeMax) {
        $salarioPersonajeMax = $salario;
        $personajeSalarioMax = $p['nombre'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>💗 Dashboard Barbie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Rubik&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6f0;
            font-family: 'Rubik', sans-serif;
        }
        h1, h3 {
            font-family: 'Pacifico', cursive;
            color: #e91e63;
        }
        .card {
            border: none;
        }
        .barbie-header {
            font-size: 3rem;
            text-shadow: 2px 2px #f8bbd0;
        }
        .badge {
            font-size: 1rem;
        }
        .btn-barbie {
            background-color: #e91e63;
            border: none;
            color: white;
        }
        .btn-barbie:hover {
            background-color: #d81b60;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <h1 class="text-center barbie-header mb-4"> Panel Mágico del Mundo Barbie </h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white mb-3 shadow" style="background-color: #f06292;">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Personajes</h5>
                    <p class="card-text fs-1"><?= $totalPersonajes ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white mb-3 shadow" style="background-color: #f48fb1;">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Profesiones</h5>
                    <p class="card-text fs-1"><?= $totalProfesiones ?></p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center">Personajes por Nivel de Experiencia</h3>
    <ul class="list-group mb-4 shadow-sm">
        <?php foreach ($experienciaStats as $nivel => $cantidad): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                🌟 <?= $nivel ?>
                <span class="badge rounded-pill bg-pink text-dark"><?= $cantidad ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3 class="text-center">Profesiones Más Populares</h3>
    <ul class="list-group mb-4 shadow-sm">
        <?php if (empty($usoProfesiones)): ?>
            <li class="list-group-item text-muted">Aún no hay profesiones registradas.</li>
        <?php else: ?>
            <?php foreach ($usoProfesiones as $profId => $count): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    💖 <?= htmlspecialchars($mapaProfesiones[$profId]['nombre'] ?? 'Desconocida') ?>
                    <span class="badge rounded-pill bg-warning text-dark"><?= $count ?> personaje(s)</span>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <h3 class="text-center"> Estadísticas Adicionales</h3>
    <div class="row mb-5">
        <div class="col-md-6">
            <ul class="list-group shadow-sm">
                <li class="list-group-item d-flex justify-content-between">
                     Edad promedio:
                    <span><?= number_format($edadPromedio, 2) ?> años</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                     Salario promedio:
                    <span>$<?= number_format($salarioPromedio, 2) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                     Profesión mejor pagada:
                    <span><?= $profesionSalarioMax ?> ($<?= number_format($salarioMax, 2) ?>)</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                     Profesión con menor salario:
                    <span><?= $profesionSalarioMin ?> ($<?= number_format($salarioMin, 2) ?>)</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                     Personaje con mayor salario:
                    <span><?= $personajeSalarioMax ?> ($<?= number_format($salarioPersonajeMax, 2) ?>)</span>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-group shadow-sm">
                <li class="list-group-item active text-center bg-pink"> Distribución por Categoría</li>
                <?php foreach ($distribucionCategorias as $cat => $cantidad): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <?= $cat ?>
                        <span class="badge bg-primary rounded-pill"><?= $cantidad ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <canvas id="graficoSalarios" class="mt-5"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('graficoSalarios').getContext('2d');

        const categorias = <?= json_encode(array_values(array_unique(array_column($profesiones, 'categoria')))); ?>;
        const salarios = <?= json_encode(array_map(function($categoria) use ($profesiones) {
            $total = 0; $count = 0;
            foreach ($profesiones as $p) {
                if ($p['categoria'] == $categoria) {
                    $total += $p['salario'];
                    $count++;
                }
            }
            return $count ? $total / $count : 0;
        }, array_values(array_unique(array_column($profesiones, 'categoria'))))); ?>;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Salario Promedio ($USD)',
                    data: salarios,
                    backgroundColor: '#ec407a',
                    borderColor: '#d81b60',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <div class="text-center my-4">
        <a href="index.php" class="btn btn-barbie px-5 py-2">Volver al Inicio</a>
    </div>
</div>
</body>
</html>
