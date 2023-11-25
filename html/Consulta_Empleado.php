<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../css/principal.css">
<title>JuegosCom</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">JuegosCOM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Empleados
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="Empleado.html">Agregar</a></li>
                            <li><a class="dropdown-item" href="Modificar_Empleado.html">Modificar</a></li>
                            <li><a class="dropdown-item" href="Consulta_Empleado.html">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Juegos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="Juego.html">Agregar</a></li>
                            <li><a class="dropdown-item" href="Modificar_Juego.html">Modificar</a></li>
                            <li><a class="dropdown-item" href="Consulta_Juego.html">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pedidos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Agregar</a></li>
                            <li><a class="dropdown-item" href="#">Actualizar</a></li>
                            <li><a class="dropdown-item" href="#">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Proveedor
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Agregar</a></li>
                            <li><a class="dropdown-item" href="#">Modificar</a></li>
                            <li><a class="dropdown-item" href="#">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Franquicias
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Agregar</a></li>
                            <li><a class="dropdown-item" href="#">Modificar</a></li>
                            <li><a class="dropdown-item" href="#">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ventas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Agregar</a></li>
                            <li><a class="dropdown-item" href="#">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Compras
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Agregar</a></li>
                            <li><a class="dropdown-item" href="#">Consultar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="columna-central">
        <div class="contenedor-sombreado">
            <div style="justify-content: center; width: 100%; display: flex;">
                <section class="Titulo">
                    <h1>Consultar empleado</h1>
                </section>
            </div>
            <br />
            <div class="row g-3 align-items-center">
                <form action="" method="post">
                    <div class="col-auto"><label for="nss-empleado">Buscar:</label></div>
                    <div class="col-5"><input type="number" class="form-control" name="consulta" placeholder="Introducir NSS de empleado" ONchange></div>
                </form>
            </div>
            <?php
            include "../php/Conexion.php";
            $salida = "";
            $query = "SELECT * FROM empleados";
            if (isset($_POST['consulta']) || $_POST['consulta'] !=  null) {
                $q = $_POST['consulta'];
                $query = "SELECT * FROM empleados WHERE nss = $q";
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
            ?>
        </div>
    </div>
</body>
<script src="../js/ComplementoBss.js"></script>

</html>