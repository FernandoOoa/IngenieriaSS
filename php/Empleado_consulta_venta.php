<?php
include "conexion.php";

$salida = "";
$query = "SELECT * FROM empleados";
echo $_POST['consulta'];
if ($_POST['consulta'] != null) {
    $q = $_POST['consulta'];
    $query = "SELECT * FROM empleados WHERE nss = '$q'";
}
$resultado = mysqli_query($conexion, $query);
if (mysqli_num_rows($resultado) > 0) {
    $salida .= "<table class='tabla-bonita'>
            <thead>
                <tr>
                    <th>NSS</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $salida .= "
        <tr>
            <td>" . $fila['nss'] . "</td>
            <td>" . $fila['nombre'] . "</td>
            </tr>";
    }
    $salida .= "</tbody></table>";
} else {
    $salida .= "No esta ese empleado";
}
echo $salida;
mysqli_close($conexion);