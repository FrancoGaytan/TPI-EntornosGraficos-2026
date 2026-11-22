<?php
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

function app_path(string $relative = ''): string
{
    return APP_ROOT . ($relative !== '' ? '/' . ltrim($relative, '/') : '');
}

function app_url(string $pagina): string
{
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    if (str_ends_with($dir, '/acciones')) {
        $dir = dirname($dir);
    }
    if ($dir === '/' || $dir === '.' || $dir === '') {
        return '/' . ltrim($pagina, '/');
    }
    return rtrim($dir, '/') . '/' . ltrim($pagina, '/');
}

function require_app(string $relative): void
{
    require_once app_path($relative);
}

function app_h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function app_die(mysqli $conexion): void
{
    error_log('MySQL: ' . mysqli_error($conexion));
    echo '<div class="alert alert-danger" role="alert">No se pudo completar la operación. Si el problema continúa, avisá al administrador.</div>';
    exit;
}

function app_clave_mensaje(string $clave): ?string
{
    if (strlen($clave) < 8) {
        return 'La contraseña debe tener al menos 8 caracteres.';
    }
    if (!preg_match('/[A-Za-zÁÉÍÓÚáéíóúÑñ]/', $clave) || !preg_match('/\d/', $clave)) {
        return 'La contraseña debe incluir letras y números.';
    }
    return null;
}

function app_clave_coincide(string $ingresada, string $guardada): bool
{
    if (str_starts_with($guardada, '$2y$') || str_starts_with($guardada, '$2a$') || str_starts_with($guardada, '$argon2')) {
        return password_verify($ingresada, $guardada);
    }
    return hash_equals($guardada, $ingresada);
}

function app_clave_es_hash(string $guardada): bool
{
    return str_starts_with($guardada, '$2y$') || str_starts_with($guardada, '$2a$') || str_starts_with($guardada, '$argon2');
}

function app_fecha_consulta_mensaje(?DateTime $fecha): ?string
{
    if (!$fecha) {
        return 'La fecha u hora no es válida.';
    }
    $ahora = new DateTime('now');
    if ($fecha <= $ahora) {
        return 'La fecha de la consulta debe ser posterior a este momento.';
    }
    $limite = (clone $ahora)->modify('+6 months');
    if ($fecha > $limite) {
        return 'La fecha no puede superar los 6 meses.';
    }
    return null;
}

function app_paginacion(int $pagina, int $paginas, string $q, array $extra = []): string
{
    if ($paginas <= 1) {
        return '';
    }
    $html = '<nav class="mt-3" aria-label="Páginas"><ul class="pagination">';
    for ($i = 1; $i <= $paginas; $i++) {
        $qs = htmlspecialchars(http_build_query(array_merge(['pagina' => $i, 'q' => $q], $extra)), ENT_QUOTES, 'UTF-8');
        $activa = $i === $pagina ? ' active' : '';
        $html .= '<li class="page-item' . $activa . '"><a class="page-link" href="?' . $qs . '">' . $i . '</a></li>';
    }
    return $html . '</ul></nav>';
}
