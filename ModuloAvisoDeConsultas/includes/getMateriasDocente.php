<?php
require_once __DIR__ . '/bootstrap.php';
require app_path('config/db.php');

$legajo = (int) ($_SESSION['legajo'] ?? 0);
$resultado = mysqli_query($conexion, "SELECT m.id, m.nombre_materia
    FROM profesor_materia pm
    JOIN materias m ON m.id = pm.id_materia
    WHERE pm.legajo_profesor = {$legajo}
    ORDER BY m.nombre_materia") or app_die($conexion);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo '<option value="' . (int) $row['id'] . '">' . app_h($row['nombre_materia']) . '</option>';
    }
} else {
    echo '<option disabled value="">No tenés cátedras asignadas</option>';
}
