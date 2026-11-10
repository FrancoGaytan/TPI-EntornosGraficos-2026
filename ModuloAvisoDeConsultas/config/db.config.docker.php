<?php
/**
 * Usar con Docker Compose (host = nombre del servicio mysql en docker-compose.yml).
 * Copiar a db.config.php antes de: docker compose up
 */
return [
    'host' => 'mysql',
    'user' => 'tpi',
    'pass' => 'tpi',
    'name' => 'consultas_materias',
];
