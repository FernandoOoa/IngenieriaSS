<?php
include "conexion.php";

$folio = $_POST['folio'];
$idempleado = $_POST['idFranquicia'];
$fecha = $_POST['fecha'];
$data = json_decode($_POST['datos'], true); // Decodificar el JSON para obtener un array asociativo
$estado = "en proceso";

$query = "INSERT INTO pedidos VALUES ('$folio', '$idFranquicia', '$idempleado', '$fecha', 'fecha_entrega', '$estado')";
if (!mysqli_query($conexion, $query)) {
    echo "<script>alert('No se pudo añadir');</script>";
    return;
}

foreach ($data as $value) {
    $idJuego = $value[0]; // Acceder a los valores del array asociativo
    $cantidad = $value[3];
    $precioVenta = $value[2];

    $salida = "INSERT INTO juegosPedido VALUES ('', '$folio', '$idJuego', '$cantidad', '$precioVenta')";
    if (!mysqli_query($conexion, $salida)) {
        echo "<script>alert('No se pudo añadir');</script>";
        return;
    }

    $query = "SELECT cantidad FROM juegos WHERE idJuego = '$idJuego'";
    $consulta = mysqli_query($conexion, $query);
    $obj = mysqli_fetch_object($consulta);
    $existencia = intval($obj->cantidad);
    $existencia -= $cantidad;

    $query = "UPDATE juegos SET cantidad = '$existencia' WHERE idJuego = '$idJuego'";
    mysqli_query($conexion, $query);
}

echo "<script>alert('Pedido registrado'); window.location.reload();</script>";
die();
?>