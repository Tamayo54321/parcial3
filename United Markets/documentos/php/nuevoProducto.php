<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        if (isset($_POST['titulo']) && isset($_POST['precio']) && isset($_POST['categoria']) && isset($_POST['entrega']) && isset($_FILES['miniatura']['tmp_name']) && $_FILES['miniatura']['tmp_name'] !== '') {
            $sqlid = mysqli_query($conexion, "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'united_markets' AND TABLE_NAME = 'productos'");
            $idproducto = mysqli_fetch_assoc($sqlid)['AUTO_INCREMENT'];
            $direccion = $idproducto . '.' . pathinfo($_FILES['miniatura']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['miniatura']['tmp_name'], "../imagenes/productos/" . $direccion);
            mysqli_query($conexion, "INSERT INTO productos (`id_cliente`, `miniatura`, `nombre`, `precio`, `entrega`, `categoria`) VALUES ('{$_SESSION['id']}', '{$direccion}', '{$_POST['titulo']}','{$_POST['precio']}','{$_POST['entrega']}', '{$_POST['categoria']}')");
        }
    }
}
header("location: ../../misproductos.php");
