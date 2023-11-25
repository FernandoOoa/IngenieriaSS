<?php
include "conexion.php";

$salida = "";
$query = "SELECT * FROM empleados";
if (isset($_POST['consulta'])) {
    $q = $_POST['consulta'];
    $query = "SELECT * FROM empleados WHERE nombre = '$q'";
}
$resultado = $conexion->query($query);
if ($resultado->num_rows > 0) {
    $salida .= "<table class='tabla-bonita'>
            <thead>
                <tr>
                    <th>NSS</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>RFC</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $salida .= "
        <tr>
            <td>" . $fila['nss'] . "</td>
            <td>" . $fila['nombre'] . "</td>
            <td>" . $fila['edad'] . "</td>
            <td>" . $fila['rfc'] . "</td>
            <td>" . $fila['estado'] . "</td>
            <td><button class='btn btn-dark' id ='Modificar'>Modificar</button></td>
            </tr>";
    }
    $salida .= "</tbody></table>";
} else {
    $salida .= "No hay datos :'(";
}
echo $salida;
$conexion->close();