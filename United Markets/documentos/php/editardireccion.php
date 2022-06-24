<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        mysqli_query($conexion, "UPDATE direcciones SET nombre='{$_POST['nombre']}', pais='{$_POST['pais']}', estado='{$_POST['estado']}', municipio='{$_POST['municipio']}', codigo_postal='{$_POST['codigo_postal']}', colonia='{$_POST['colonia']}', calle='{$_POST['calle']}', numero_casa='{$_POST['numero_casa']}', telefono='{$_POST['telefono']}' WHERE id={$_POST['id']} ");
    }
}
header("location: ../../direcciones.php");
