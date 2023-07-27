<?php

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$campos = "producto.producto_id, producto.producto_nombre, producto.producto_referencia, producto.producto_precio, producto.producto_peso, producto.categoria_id, producto.producto_stock, producto.FechaCreacion, producto.FechaActualizacion, categoria.categoria_id, categoria.categoria_nombre, usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido";

if (isset($busqueda) && $busqueda != "") {
    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id = categoria.categoria_id INNER JOIN usuario ON producto.usuario_id = usuario.usuario_id WHERE producto.producto_referencia LIKE '%$busqueda%' OR producto.producto_nombre LIKE '%$busqueda%' ORDER BY producto.producto_id ASC LIMIT $inicio, $registros";
    $consulta_total = "SELECT COUNT(producto_id) FROM producto WHERE producto_referencia LIKE '%$busqueda%' OR producto_nombre LIKE '%$busqueda%'";
} elseif ($categoria_id > 0) {
    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id = categoria.categoria_id INNER JOIN usuario ON producto.usuario_id = usuario.usuario_id WHERE producto.categoria_id = '$categoria_id' ORDER BY producto.producto_id ASC LIMIT $inicio, $registros";
    $consulta_total = "SELECT COUNT(producto_id) FROM producto WHERE categoria_id = '$categoria_id'";
} else {
    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id = categoria.categoria_id INNER JOIN usuario ON producto.usuario_id = usuario.usuario_id ORDER BY producto.producto_id ASC LIMIT $inicio, $registros";
    $consulta_total = "SELECT COUNT(producto_id) FROM producto";
}

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

$Npaginas = ceil($total / $registros);

$tabla .= '
<div class="table-container" style="overflow-x: auto;">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>ID</th>
                <th>Nombre de producto</th>
                <th>Referencia</th>
                <th>Precio (COP)</th>
                <th>Peso (gr)</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Fecha de creación</th>
                <th>Fecha de actualización</th>
                <th>Categoría ID</th>
                <th>Usuario ID</th>
                <th>Registrado Por</th>
                <th colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    foreach ($datos as $rows) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td>' . $rows['producto_id'] . '</td>
                <td>' . $rows['producto_nombre'] . '</td>
                <td>' . $rows['producto_referencia'] . '</td>
                <td>' . $rows['producto_precio'] . '</td>
                <td>' . $rows['producto_peso'] . '</td>
                <td>' . $rows['categoria_nombre'] . '</td>
                <td>' . $rows['producto_stock'] . '</td>
                <td>' . $rows['FechaCreacion'] . '</td>
                <td>' . $rows['FechaActualizacion'] . '</td>
                <td>' . $rows['categoria_id'] . '</td>
                <td>' . $rows['usuario_id'] . '</td>
                <td>' . $rows['usuario_nombre'] . ' ' . $rows['usuario_apellido'] . '</td>
                <td>
                    <a href="index.php?vista=product_update&product_id_up=' . $rows['producto_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
                </td>
                <td>
                    <a href="' . $url . $pagina . '&product_id_del=' . $rows['producto_id'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
                </td>
            </tr>
        ';
    }
} else {
    if ($total >= 1) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="14">
                    <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                        Haga clic acá para recargar el listado
                    </a>
                </td>
            </tr>
        ';
    } else {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="14">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando productos <strong>' . ($inicio + 1) . '</strong> al <strong>' . ($inicio + count($datos)) . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion = null;
echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
?>
