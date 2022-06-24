<?php
$conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

if ($conexion->connect_error) {
    die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
}

if (strlen($_POST['nombre']) >= 6 &&  strlen($_POST['correo']) >= 10 && strlen($_POST['contrasena']) >= 6 && strlen($_POST['contrasena']) >= 6 && $_POST['contrasenarepeat'] == $_POST['contrasenarepeat'] && strlen($_POST['cellphone']) >= 6) {
    $cuentavalidasql = mysqli_query($conexion, "SELECT count(correo) as correo FROM clientes WHERE correo='{$_POST['correo']}'");
    $cuentavalida = mysqli_fetch_assoc($cuentavalidasql)['correo'];
    if ($cuentavalida == 0) {
        mysqli_query($conexion, "INSERT INTO `clientes` (`nombre`, `correo`, `contrasena`, `celular`) VALUES ('{$_POST['nombre']}', '{$_POST['correo']}', '{$_POST['contrasena']}', {$_POST['cellphone']} )");
        header('location: ../../login.html');
    }
}
header('location: ../../registrar.html');
