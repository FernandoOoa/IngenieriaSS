<?php
include "Conexion.php";
$password = $_POST['password'];
$id = $_POST['id'];
$query = "SELECT idempleado,password FROM empleado where idempleado ='$id'";
$consulta = mysqli_query($conexion, $query);
$obj = mysqli_fetch_object($consulta);
$cont = $obj->password;
if (intval($password) == $cont) {
    echo "<script>
            alert('Contraseña e ID correctos');
            location.assign('Empleado.php');
            </script>";
} else {
    echo "<script>
            alert('Alguno de los datos esta mal(conexion fallida)');
            location.assign('Inicio_Sesion.html');
            </script>";
}
die();
