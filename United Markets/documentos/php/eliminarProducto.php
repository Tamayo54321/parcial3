<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        $archivosql = mysqli_query($conexion, "SELECT miniatura FROM productos WHERE id_cliente={$_SESSION['id']} AND id={$_GET['id']}");
        $archivo = mysqli_fetch_assoc($archivosql)['miniatura'];
        if (mysqli_query($conexion, "DELETE FROM `productos` WHERE id_cliente = {$_SESSION['id']} AND id = {$_GET['id']}")) {
            unlink("../imagenes/productos/" . $archivo);
        }
    }
}
header("location: ../../misproductos.php");
