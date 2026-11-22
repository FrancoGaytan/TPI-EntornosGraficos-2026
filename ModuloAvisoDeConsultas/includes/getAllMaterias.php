<?php
require_once __DIR__ . '/bootstrap.php';
require app_path('config/db.php');

$consulta="SELECT * FROM materias";
$resultado=mysqli_query($conexion,$consulta) or app_die($conexion);

if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $etiqueta = $row["nombre_materia"];
        if (!empty($row["comision"])) {
            $etiqueta .= " - COM:" . $row["comision"];
        }
        $selected = (isset($_GET['idMateria']) && (string) $_GET['idMateria'] === (string) $row['id']) ? ' selected' : '';
        echo "<option value='" . (int) $row["id"] . "'" . $selected . ">" . app_h($etiqueta) . "</option>";
    }
}
else {
    echo "<option disabled value=''>No existen materias cargadas</option>";
}
?>
