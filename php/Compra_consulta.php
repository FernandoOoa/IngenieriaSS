<?php
include "conexion.php";

$salida = "";
$query = "SELECT * FROM compras";

echo $_POST['consulta'];
if ($_POST['consulta'] != null) {
    $q = $_POST['consulta'];
    $query = "SELECT * FROM compras WHERE folioCompra LIKE '$q%'";
}
$resultado = mysqli_query($conexion, $query);


if (mysqli_num_rows($resultado) > 0) {
    $salida .= "<table class='tabla-bonita'>
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Nombre Proveedor</th>
						<th>Nombre Empleado</th>
                        <th>Fecha</th>
                        <th>ID Juego</th>
                        <th>Nombre juego</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>";
				
	$total = 0;
	
	while ($fila = mysqli_fetch_assoc($resultado)) {
		
		$proveedorQuery = "SELECT * FROM proveedores WHERE idProveedor = '". $fila['idProveedor'] ."' ";
		$proveedorResult = mysqli_query($conexion, $proveedorQuery);
		$proveedor = mysqli_fetch_assoc($proveedorResult);
		
		$empleadoQuery = "SELECT * FROM empleados WHERE nss = '". $fila['nss'] ."' ";
		$empleadoResult = mysqli_query($conexion, $empleadoQuery);
		$empleado = mysqli_fetch_assoc($empleadoResult);
		
		$juegoCompraQuery = "SELECT * FROM JuegosCompra WHERE folioCompra = '". $fila['folioCompra'] ."' ";
		$juegoCompraResult = mysqli_query($conexion, $juegoCompraQuery);

						
		while ($juegoCompra = mysqli_fetch_assoc($juegoCompraResult)) {
			
			$juegoQuery = "SELECT * FROM Juegos WHERE idJuego = '".$juegoCompra['idJuego']."'";
			$juegoResult = mysqli_query($conexion, $juegoQuery);
			$juego = mysqli_fetch_assoc($juegoResult);
			
			$salida .= "
					<tr>
                        <td>" . $fila['folioCompra'] . "</td>
						<td>" .$proveedor['nombre']. "</td>
						<td>" .$empleado['nombre']. "</td>
						<td>" . $fila['fecha'] . "</td>
						<td>" .$juegoCompra['idJuego']. "</td>
						<td>" . $juego['nombre'] . "</td>
						<td>" .$juegoCompra['cantidad']. "</td>
						<td>" .$juego['precioCompra']. "</td>
						<td>" . $fila['estado'] . "</td>
                    </tr>";
			
			
			$cant = $juegoCompra['cantidad'];
			$cost = $juego['precioCompra']; 
			
			$aux = $cant * $cost;
			$total = $total+$aux;
		}
    }
	$IVA = $total*0.16;
	$TotalFinal = $total+$IVA;
	
    $salida .= "<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td>Sub total:</td>
                        <td>" .$total. "</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td>IVA:</td>
                        <td>" .$IVA."</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td>Total:</td>
                        <td>".$TotalFinal."</td>
                        <td></td>
                        <td></td></tbody></table>";
} else {
    $salida .= "No hay datos :'(";
}
echo $salida;
mysqli_close($conexion);
