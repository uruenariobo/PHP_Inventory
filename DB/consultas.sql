-- Consultas principales

/* Para obtener el producto que tiene más stock (Esta consulta buscará el producto que 
tenga el mayor valor en la columna producto_stock):
*/

SELECT producto_nombre, producto_stock
FROM producto
WHERE producto_stock = (SELECT MAX(producto_stock) FROM producto);

/*Para obtener el producto más vendido:

(Esta consulta une las tablas producto y 
venta mediante la columna producto_id, luego agrupa los registros por producto 
y suma la cantidad vendida para cada producto. Finalmente, ordena los resultados 
en orden descendente por la suma de las ventas y limita el resultado a un solo 
registro para obtener el producto más vendido.)
*/

SELECT p.producto_nombre, SUM(v.venta_cantidad) AS total_ventas
FROM producto p
JOIN venta v ON p.producto_id = v.producto_id
GROUP BY p.producto_id, p.producto_nombre
ORDER BY total_ventas DESC
LIMIT 1;
