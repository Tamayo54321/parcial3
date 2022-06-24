<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        $sql = mysqli_query($conexion, "SELECT precio FROM productos WHERE id = {$_POST['id']}");
        $precio = mysqli_fetch_array($sql)['precio'];

        mysqli_query($conexion, "INSERT INTO `pedidos` (`id_cliente`, `id_producto`, `precio`, `cantidad`, `estado`) VALUES ('{$_SESSION['id']}', '{$_POST['id']}', '{$precio}', '{$_POST['cantidad']}', 'EN CURSO')");
    }
}
header("location: ../../pedidos.php");
