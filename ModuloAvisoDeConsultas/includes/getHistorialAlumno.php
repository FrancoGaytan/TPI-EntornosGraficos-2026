<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/paginacion.php';
require app_path('config/db.php');

$legajo = (int) $_SESSION['legajo'];
$where = "ac.legajo_alumno = {$legajo} AND ac.cancelada = 0 AND c.fecha_hora < NOW()";
$Cant_por_Pag = 10;
$cuenta = mysqli_query($conexion, "SELECT ac.id_consulta FROM alumno_consulta ac JOIN consultas c ON c.id = ac.id_consulta WHERE {$where}") or app_die($conexion);
$total_registros = mysqli_num_rows($cuenta);
list($inicio, $pagina, $total_paginas) = paginar($total_registros, $Cant_por_Pag, 'pagina_historial');

echo '<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Materia</th><th>Docente</th><th>Cuándo</th></tr></thead><tbody>';

$resultado = mysqli_query($conexion, "SELECT c.fecha_hora, c.estado, c.motivo, m.nombre_materia, p.nombre, p.apellido
    FROM alumno_consulta ac
    JOIN consultas c ON c.id = ac.id_consulta
    JOIN materias m ON m.id = c.id_materia
    JOIN profesores p ON p.legajo = c.id_profesor
    WHERE {$where}
    ORDER BY c.fecha_hora DESC
    LIMIT {$inicio}, {$Cant_por_Pag}") or app_die($conexion);

$estados = [1 => 'Realizada', 0 => 'Bloqueada', 2 => 'Cancelada'];

if ($resultado->num_rows === 0) {
    echo '<tr><td colspan="3">Todavía no hay consultas pasadas.</td></tr>';
}

while ($row = $resultado->fetch_assoc()) {
    $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $row['fecha_hora']);
    $estado = $estados[(int) $row['estado']] ?? 'Cerrada';
    $extra = !empty($row['motivo']) ? ' — ' . app_h($row['motivo']) : '';
    echo '<tr>
        <td>' . app_h($row['nombre_materia']) . '</td>
        <td>' . app_h($row['nombre'] . ' ' . $row['apellido']) . '</td>
        <td>' . $fecha->format('d-m-Y H:i') . '<br><small>' . $estado . $extra . '</small></td>
    </tr>';
}
echo '</tbody></table></div>';
enlaces_paginacion($pagina, $total_paginas, 'pagina_historial');
