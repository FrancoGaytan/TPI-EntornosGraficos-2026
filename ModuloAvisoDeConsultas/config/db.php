<?php
$configPath = __DIR__ . '/db.config.php';
if (!is_file($configPath)) {
    die(
        'Falta config/db.config.php. Copiá config/db.config.example.php → config/db.config.php (ver database/README.md).'
    );
}

$cfg = require $configPath;

$conexion = mysqli_connect(
    $cfg['host'],
    $cfg['user'],
    $cfg['pass'],
    $cfg['name']
);

if (!$conexion) {
    die('Error de conexión MySQL: ' . mysqli_connect_error());
}

mysqli_set_charset($conexion, 'utf8mb4');
