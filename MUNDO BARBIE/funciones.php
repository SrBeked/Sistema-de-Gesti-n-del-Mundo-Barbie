<?php

function leerJSON($archivo) {
    if (!file_exists($archivo)) {
        file_put_contents($archivo, json_encode([]));
    }
    return json_decode(file_get_contents($archivo), true);
}

function guardarJSON($archivo, $datos) {
    file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT));
}

function generarIDUnico() {
    return uniqid();
}

function calcularEdad($fechaNacimiento) {
    $hoy = new DateTime();
    $fecha = new DateTime($fechaNacimiento);
    return $hoy->diff($fecha)->y;
}
