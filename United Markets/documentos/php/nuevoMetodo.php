<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['estatus'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');

        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        $vencimiento = $_POST['mes'] . "/" . $_POST['year'];
        mysqli_query($conexion, "INSERT INTO `metodos_pago` (`id_cliente`, `numero`, `vencimiento`, `cvv`, `nombre`) VALUES ('{$_SESSION['id']}', '{$_POST['numero']}', '{$vencimiento}', '{$_POST['cvv']}', '{$_POST['nombre']}'");
    }
}
header("location: ../../metodosdepago.php");
