<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        if (isset($_POST['nombre'])) {
            mysqli_query($conexion, "UPDATE clientes SET nombre='{$_POST['nombre']}' WHERE id={$_SESSION['id']} ");
            $_SESSION['nombre'] = $_POST['nombre'];
        } else if (isset($_POST['correo'])) {
            mysqli_query($conexion, "UPDATE clientes SET correo='{$_POST['correo']}' WHERE id={$_SESSION['id']} ");
            $_SESSION['correo'] = $_POST['correo'];
        } else if (isset($_POST['telefono'])) {
            mysqli_query($conexion, "UPDATE clientes SET celular='{$_POST['telefono']}' WHERE id={$_SESSION['id']} ");
            $_SESSION['celular'] = $_POST['telefono'];
        } else if (isset($_POST['passactual']) && isset($_POST['passnueva'])) {
            $sql = mysqli_query($conexion, "SELECT count(id) as total FROM clientes WHERE correo = '{$_SESSION['correo']}' AND contrasena = '{$_POST['contrasena']}'");
            $cantidad = mysqli_fetch_array($sql)['total'];
            if ($cantidad == 1) {
                mysqli_query($conexion, "UPDATE clientes SET contrasena='{$_POST['passnueva']}' WHERE id={$_SESSION['id']} ");
            }
        }
    }
}
header("location: ../../editarcuenta.html");
