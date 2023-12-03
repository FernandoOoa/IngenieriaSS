<?php
include "conexion.php";

$salida = "";
$query = "SELECT * FROM juegos";
if ($_POST['idJuego'] != null) {
    $q = $_POST['idJuego'];
    $query = "SELECT * FROM juegos WHERE idjuego LIKE '$q%'";
}
$resultado = mysqli_query($conexion, $query);
if (mysqli_num_rows($resultado) > 0) {
    $salida .= "<table class='tabla-bonita'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Clasificacion</th>
                    <th>Precio C/U</th>
                    <th>Inventario</th>
                    <th>Cantidad</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $salida .= "
        <tr>
            <td>" . $fila['idJuego'] . "</td>
            <td>" . $fila['nombre'] . "</td>
            <td>" . $fila['clasificacion'] . "</td>
            <td>" . $fila['precioVenta'] . "</td>
			<td>" . $fila['cantidad'] . "</td>
            <td><input type='number'></td>
            <td><a class='btn btn-bd-light'>Añadir</button></td>
            </tr>";
    }
    $salida .= "</tbody></table>";
} else {
    $salida .= "No hay datos :'(";
}
echo $salida;
mysqli_close($conexion);
