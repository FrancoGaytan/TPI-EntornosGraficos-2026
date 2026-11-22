<?php
require_once __DIR__ . '/bootstrap.php';
require app_path('config/db.php');

$q = trim($_GET['q'] ?? '');
$pendientes = (($_GET['pendientes'] ?? '') === '1');
$pagina = max(1, (int) ($_GET['pagina'] ?? 1));
$porPagina = 10;
$where = '';
if ($q !== '') {
    $like = '%' . $conexion->real_escape_string($q) . '%';
    $where = "WHERE p.nombre LIKE '{$like}' OR p.apellido LIKE '{$like}' OR p.email LIKE '{$like}' OR CAST(p.legajo AS CHAR) LIKE '{$like}'";
}
if ($pendientes) {
    $where .= ($where === '' ? 'WHERE ' : ' AND ') . 'p.activo = 0';
}

$conteo = mysqli_query($conexion, "SELECT COUNT(*) AS n FROM profesores p {$where}") or app_die($conexion);
$total = (int) mysqli_fetch_assoc($conteo)['n'];
$paginas = max(1, (int) ceil($total / $porPagina));
if ($pagina > $paginas) {
    $pagina = $paginas;
}
$offset = ($pagina - 1) * $porPagina;
$resultado = mysqli_query($conexion, "SELECT p.legajo, p.nombre, p.apellido, p.email, p.activo,
        GROUP_CONCAT(m.nombre_materia ORDER BY m.nombre_materia SEPARATOR ', ') AS catedras
    FROM profesores p
    LEFT JOIN profesor_materia pm ON pm.legajo_profesor = p.legajo
    LEFT JOIN materias m ON m.id = pm.id_materia
    {$where}
    GROUP BY p.legajo, p.nombre, p.apellido, p.email, p.activo
    ORDER BY p.apellido, p.nombre
    LIMIT {$porPagina} OFFSET {$offset}") or app_die($conexion);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $estado = (int) $row['activo'] === 1 ? 'Activo' : 'Pendiente de aprobación';
        $catedras = ($row['catedras'] !== null && $row['catedras'] !== '') ? $row['catedras'] : 'Sin cátedra';
        echo '<tr>
            <td>
                <p class="admin-persona">' . app_h($row['apellido'] . ', ' . $row['nombre']) . '</p>
                <p>Legajo: ' . (int) $row['legajo'] . '</p>
                <p>' . app_h($row['email']) . '</p>
                <p>Cátedra: ' . app_h($catedras) . '</p>
                <p><b>' . $estado . '</b></p>
            </td>
            <td class="admin-acciones-celda">
                <div class="admin-fila-acciones">
                <a class="btn btn-sm btn-outline-primary" href="editarDocente.php?legajo=' . (int) $row['legajo'] . '">Editar</a>
                <a class="btn btn-sm btn-outline-danger" onclick="return confirm(\'¿Eliminar este docente?\');" href="acciones/deleteDocente.php?legajo=' . (int) $row['legajo'] . '">Eliminar</a>';
        if ((int) $row['activo'] !== 1) {
            echo '<a class="btn btn-sm btn-outline-secondary" href="acciones/aprobarDocente.php?legajo=' . (int) $row['legajo'] . '">Aprobar</a>';
        }
        echo '</div></td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="2"><b>No hay docentes para esa búsqueda.</b></td></tr>';
}

$paginacion_html = app_paginacion($pagina, $paginas, $q, $pendientes ? ['pendientes' => '1'] : []);
