<?php
include "conexion.php";

$salida = "";
$query = "SELECT * FROM ventas";

echo $_POST['consulta'];
if ($_POST['consulta'] != null) {
    $q = $_POST['consulta'];
    $query = "SELECT * FROM ventas WHERE folioVenta LIKE '$q%'";
}
$resultado = mysqli_query($conexion, $query);


if (mysqli_num_rows($resultado) > 0) {
    $salida .= "<table class='tabla-bonita'>
                <thead>
                    <tr>
                        <th>Folio venta</th>
                        <th>Id vendeedor</th>
                        <th>Nombre Vendedor</th>
                        <th>Fecha</th>
                        <th>ID Juego</th>
                        <th>Nombre juego</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";
				
	$total = 0;
	
	while ($fila = mysqli_fetch_assoc($resultado)) {
				
		$empleadoQuery = "SELECT * FROM empleados WHERE nss = '". $fila['nss'] ."' ";
		$empleadoResult = mysqli_query($conexion, $empleadoQuery);
		$empleado = mysqli_fetch_assoc($empleadoResult);
		
		$juegoVentaQuery = "SELECT * FROM JuegosVenta WHERE folioVenta = '". $fila['folioVenta'] ."' ";
		$juegoVentaResult = mysqli_query($conexion, $juegoVentaQuery);

						
		while ($juegoVenta = mysqli_fetch_assoc($juegoVentaResult)) {
			
			$juegoQuery = "SELECT * FROM Juegos WHERE idJuego = '".$juegoVenta['idJuego']."'";
			$juegoResult = mysqli_query($conexion, $juegoQuery);
			$juego = mysqli_fetch_assoc($juegoResult);
			
			$cant = $juegoVenta['cantidad'];
			$cost = $juego['precioVenta']; 
			
			$aux = $cant * $cost;
			$total = $total+$aux;
			
			$salida .= "
					<tr>
                        <td>" . $fila['folioVenta'] . "</td>
						<td>" .$empleado['nss']. "</td>
						<td>" .$empleado['nombre']. "</td>
						<td>" . $fila['fecha'] . "</td>
						<td>" .$juegoVenta['idJuego']. "</td>
						<td>" . $juego['nombre'] . "</td>
						<td>" .$juegoVenta['cantidad']. "</td>
						<td>" .$juego['precioVenta']. "</td>
						<td>" . $aux . "</td>
                    </tr>";
			
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
						<td>Total:</td>
                        <td>".$TotalFinal."</td>
                        <td></td>
                        <td></td></tbody></table>";
} else {
    $salida .= "No hay datos :'(";
}
echo $salida;
mysqli_close($conexion);
