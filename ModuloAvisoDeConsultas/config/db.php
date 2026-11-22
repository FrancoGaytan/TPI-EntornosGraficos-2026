<?php
$configPath = __DIR__ . '/db.config.php';
if (!is_file($configPath)) {
    die(
        'Falta config/db.config.php. Copiá config/db.config.example.php → config/db.config.php (ver database/README.md).'
    );
}

$cfg = require $configPath;

if (!isset($GLOBALS['conexion']) || !($GLOBALS['conexion'] instanceof mysqli)) {
    $GLOBALS['conexion'] = mysqli_connect(
        $cfg['host'],
        $cfg['user'],
        $cfg['pass'],
        $cfg['name']
    );

    if (!$GLOBALS['conexion']) {
        die('Error de conexión MySQL: ' . mysqli_connect_error());
    }

    mysqli_set_charset($GLOBALS['conexion'], 'utf8mb4');
}

// Incluir este archivo con require (no desde una función): $conexion queda en el ámbito de quien lo pide.
$conexion = $GLOBALS['conexion'];
