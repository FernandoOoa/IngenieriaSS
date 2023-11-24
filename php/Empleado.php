<?php
include "Conexion.php";
$nombre = $_POST['nombre_empleado'];

echo "<script>
            alert('$nombre')</script>";
