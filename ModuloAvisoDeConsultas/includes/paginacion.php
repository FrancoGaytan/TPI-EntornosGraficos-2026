<?php
/**
 * Misma lógica que el listado paginado de la práctica (flujo B4).
 * Cantidad fija: 10. inicio = (pagina - 1) * Cant_por_Pag y LIMIT inicio, Cant_por_Pag.
 */
function paginar($total_registros, $Cant_por_Pag = 10, $nombre = 'pagina')
{
    $pagina = isset($_GET[$nombre]) ? $_GET[$nombre] : null;

    if (!$pagina) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $pagina = (int) $pagina;
        if ($pagina < 1) {
            $pagina = 1;
        }
        $inicio = ($pagina - 1) * $Cant_por_Pag;
    }

    $total_paginas = $total_registros > 0 ? (int) ceil($total_registros / $Cant_por_Pag) : 1;
    if ($pagina > $total_paginas) {
        $pagina = $total_paginas;
        $inicio = ($pagina - 1) * $Cant_por_Pag;
    }

    echo "Número de registros: $total_registros<br>";
    echo "Páginas de $Cant_por_Pag registros<br>";
    echo "Mostrando la página $pagina de $total_paginas<p>";

    return [$inicio, $pagina, $total_paginas];
}

function enlaces_paginacion($pagina, $total_paginas, $nombre = 'pagina')
{
    if ($total_paginas > 1) {
        $conservar = $_GET;
        unset($conservar[$nombre]);
        echo '<p class="paginacion">';
        for ($i = 1; $i <= $total_paginas; $i++) {
            if ((int) $pagina === $i) {
                echo '<span>' . $pagina . '</span>';
            } else {
                $conservar[$nombre] = $i;
                $href = '?' . http_build_query($conservar);
                echo "<a href='" . app_h($href) . "'>$i</a>";
            }
        }
        echo '</p>';
    }
}
