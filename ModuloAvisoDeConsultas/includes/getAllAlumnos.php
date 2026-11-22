<?php
require_once __DIR__ . '/bootstrap.php';
require app_path('config/db.php');

$q = trim($_GET['q'] ?? '');
$pagina = max(1, (int) ($_GET['pagina'] ?? 1));
$porPagina = 10;
$where = '';
if ($q !== '') {
    $like = '%' . $conexion->real_escape_string($q) . '%';
    $where = "WHERE nombre LIKE '{$like}' OR apellido LIKE '{$like}' OR email LIKE '{$like}' OR CAST(legajo AS CHAR) LIKE '{$like}'";
}

$conteo = mysqli_query($conexion, "SELECT COUNT(*) AS n FROM alumnos {$where}") or app_die($conexion);
$total = (int) mysqli_fetch_assoc($conteo)['n'];
$paginas = max(1, (int) ceil($total / $porPagina));
if ($pagina > $paginas) {
    $pagina = $paginas;
}
$offset = ($pagina - 1) * $porPagina;
$resultado = mysqli_query($conexion, "SELECT * FROM alumnos {$where} ORDER BY apellido, nombre LIMIT {$porPagina} OFFSET {$offset}") or app_die($conexion);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr>
            <td>
                <p class="admin-persona">' . app_h($row['apellido'] . ', ' . $row['nombre']) . '</p>
                <p>Legajo: ' . (int) $row['legajo'] . '</p>
                <p>' . app_h($row['email']) . '</p>
            </td>
            <td class="admin-acciones-celda">
                <div class="admin-fila-acciones">
                    <a class="btn btn-sm btn-outline-primary" href="editarAlumno.php?legajo=' . (int) $row['legajo'] . '">Editar</a>
                    <a class="btn btn-sm btn-outline-danger" onclick="return confirm(\'¿Eliminar este alumno?\');" href="acciones/deleteAlumno.php?legajo=' . (int) $row['legajo'] . '">Eliminar</a>
                </div>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="2"><b>No hay alumnos para esa búsqueda.</b></td></tr>';
}

$paginacion_html = app_paginacion($pagina, $paginas, $q);
