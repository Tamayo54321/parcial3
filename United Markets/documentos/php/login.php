<?php
$conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

if ($conexion->connect_error) {
    die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
}

if (strlen($_POST['correo']) > 10 && strlen($_POST['contrasena']) >= 6) {
    $validarcuenta1 = mysqli_query($conexion, "SELECT count(id) as clientes FROM clientes WHERE correo='" . $_POST['correo'] . "' AND contrasena='" . $_POST['contrasena'] . "' ");
    $validarcuenta2 = mysqli_fetch_array($validarcuenta1)['clientes'];
    if ($validarcuenta2 == 1) {
        $datossql = mysqli_query($conexion, "SELECT id,nombre,correo,celular FROM clientes WHERE correo='" . $_POST['correo'] . "' AND contrasena='" . $_POST['contrasena'] . "' ");
        $datos = mysqli_fetch_assoc($datossql);
        session_start();
        $_SESSION['estatus'] = TRUE;
        $_SESSION['id'] = $datos['id'];
        $_SESSION['nombre'] = $datos['nombre'];
        $_SESSION['correo'] = $datos['correo'];
        $_SESSION['celular'] = $datos['celular'];
        header('location: ../../index.php');
    }
}
