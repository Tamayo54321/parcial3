<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        mysqli_query($conexion, "DELETE FROM `metodos_pago` WHERE id_cliente = {$_SESSION['id']} AND id = {$_GET['id']}");
    }
}
header("location: ../../metodosdepago.php");
