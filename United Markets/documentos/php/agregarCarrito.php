<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        $sql = mysqli_query($conexion, "SELECT count(id) as total FROM carrito WHERE id_cliente = {$_SESSION['id']} AND id_producto = {$_POST['id']}");
        $cantidad = mysqli_fetch_array($sql)['total'];
        if ($cantidad == 0) {
            mysqli_query($conexion, "INSERT INTO `carrito` (`id_cliente`, `id_producto`) VALUES ('{$_SESSION['id']}', '{$_POST['id']}');");
        } else {
            mysqli_query($conexion, "DELETE FROM `carrito` WHERE id_cliente = {$_SESSION['id']} AND id_producto = {$_POST['id']}");
        }
    }
}
