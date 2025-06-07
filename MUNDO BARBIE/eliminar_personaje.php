<?php
$archivo = 'data/personajes.json';

$id = $_GET['id'] ?? '';

if ($id) {
    $personajes = json_decode(file_get_contents($archivo), true) ?? [];
    $personajes = array_filter($personajes, fn($p) => (string)$p['id'] !== (string)$id);
    $personajes = array_values($personajes);
    file_put_contents($archivo, json_encode($personajes, JSON_PRETTY_PRINT));
}

header('Location: listar_personajes.php');
exit();
?>
