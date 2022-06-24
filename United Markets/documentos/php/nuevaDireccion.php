<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        mysqli_query($conexion, "INSERT INTO `direcciones` (`id_cliente`, `nombre`, `pais`, `estado`, `municipio`, `codigo_postal`, `colonia`, `calle`, `numero_casa`, `telefono`) VALUES ('{$_SESSION['id']}', '{$_POST['nombre']}', '{$_POST['pais']}', '{$_POST['estado']}', '{$_POST['municipio']}', '{$_POST['codigo_postal']}', '{$_POST['colonia']}', '{$_POST['calle']}', '{$_POST['numero_casa']}', '{$_POST['telefono']}')");
    }
}
header("location: ../../direcciones.php");
