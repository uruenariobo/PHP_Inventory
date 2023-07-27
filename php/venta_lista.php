<?php
// venta_lista.php

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$consulta_datos = "SELECT venta.*, producto.producto_nombre FROM venta INNER JOIN producto ON venta.producto_id = producto.producto_id ORDER BY venta.venta_id ASC LIMIT $inicio,$registros";
$consulta_total = "SELECT COUNT(venta_id) FROM venta";

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

$Npaginas = ceil($total / $registros);

$tabla .= '
<div class="table-container">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>Venta ID</th>
                <th>Id del Producto</th>
                <th>Nombre del Producto</th>
                <th>Cantidad Vendida</th>
                <th>Fecha de Venta</th>
            </tr>
        </thead>
        <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td>' . $contador . '</td>
                <td>' . $rows['producto_id'] . '</td>
                <td>' . $rows['producto_nombre'] . '</td>
                <td>' . $rows['venta_cantidad'] . '</td>
                <td>' . $rows['venta_fecha'] . '</td>
            </tr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    if ($total >= 1) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="5">
                    <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                        Haga clic acá para recargar el listado
                    </a>
                </td>
            </tr>
        ';
    } else {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="5">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando ventas <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion = null;
echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
