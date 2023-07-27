<?php
require_once "main.php";

function obtener_producto_por_id($producto_id) {
    $producto_id = limpiar_cadena($producto_id);

    // Verificar que el ID del producto sea válido (número positivo)
    if (!is_numeric($producto_id) || $producto_id <= 0) {
        return false;
    }

    // Realizar la consulta para obtener el producto por su ID
    $conexion = conexion();
    $consulta = $conexion->prepare("SELECT * FROM producto WHERE producto_id = :producto_id");
    $consulta->bindParam(":producto_id", $producto_id, PDO::PARAM_INT);
    $consulta->execute();

    $producto = $consulta->fetch(PDO::FETCH_ASSOC);
    $conexion = null;

    return $producto;
}

function nueva_venta($producto_id, $cantidad_vendida) {
    $producto_id = limpiar_cadena($producto_id);
    $cantidad_vendida = limpiar_cadena($cantidad_vendida);

    // Verificar que los datos sean válidos (números positivos)
    if (!is_numeric($producto_id) || !is_numeric($cantidad_vendida) || $producto_id <= 0 || $cantidad_vendida <= 0) {
        return false;
    }

    // Actualizar el stock del producto restando la cantidad vendida
    $conexion = conexion();
    $consulta = $conexion->prepare("UPDATE producto SET producto_stock = producto_stock - :cantidad_vendida WHERE producto_id = :producto_id");
    $consulta->bindParam(":cantidad_vendida", $cantidad_vendida, PDO::PARAM_INT);
    $consulta->bindParam(":producto_id", $producto_id, PDO::PARAM_INT);
    $consulta->execute();

    // Registrar la venta en la tabla de ventas
    $fecha_actual = date("Y-m-d");
    $consulta = $conexion->prepare("INSERT INTO venta (producto_id, venta_cantidad, venta_fecha) VALUES (:producto_id, :cantidad_vendida, :venta_fecha)");
    $consulta->bindParam(":producto_id", $producto_id, PDO::PARAM_INT);
    $consulta->bindParam(":cantidad_vendida", $cantidad_vendida, PDO::PARAM_INT);
    $consulta->bindParam(":venta_fecha", $fecha_actual);
    $consulta->execute();

    $conexion = null;
    return true;
}

// Almacenando datos del formulario
$producto_id = limpiar_cadena($_POST['venta_id']);
$cantidad_vendida = limpiar_cadena($_POST['venta_cantidad']);

// Validar campos y realizar la venta
$producto = obtener_producto_por_id($producto_id);
if (!$producto || $producto['producto_stock'] <= 0 || $producto['producto_stock'] < $cantidad_vendida) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Stock insuficiente!</strong><br>
            El producto no tiene suficiente stock para realizar la venta.
        </div>
    ';
} else {
    nueva_venta($producto_id, $cantidad_vendida);

    echo '
        <div class="notification is-info is-light">
            <strong>¡Venta realizada!</strong><br>
            La venta se realizó con éxito.
        </div>
    ';
}
?>
