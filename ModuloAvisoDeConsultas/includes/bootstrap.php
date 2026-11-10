<?php
/**
 * Rutas base del módulo (funciona en raíz del proyecto o en subcarpeta de htdocs).
 */
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

function app_path(string $relative = ''): string
{
    return APP_ROOT . ($relative !== '' ? '/' . ltrim($relative, '/') : '');
}

function require_app(string $relative): void
{
    require_once app_path($relative);
}
