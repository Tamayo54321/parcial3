<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['estatus'])) {
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="documentos/css/bootstrap.css">
    <script src="documentos/js/jquery-1.11.1.min.js"></script>
    <title>United Markets</title>
    <style>
        @font-face {
            font-family: "HelloJucky";
            src: url('documentos/HELLOJUCKY.otf');
        }

        * {
            margin: 0;
            padding: 0;
            border: 0;
            vertical-align: baseline;
        }

        body {
            background: rgb(230, 230, 230);

        }

        #TopBar {
            min-width: 100vw;
            width: 100vw;
            background: rgb(63, 92, 255);
            color: white;
        }

        .BUSCADOR {
            border-radius: 0;
            border: solid 2px black;
            justify-content: space-around;
        }

        .LOGO {
            text-align: center;
            font-family: "HelloJucky";
            color: yellow;
            font-size: 25px;
            cursor: pointer;
        }

        .contenido {
            height: fit-content;
            width: 100vw;
        }

        .titulos {
            font-size: 20px;
            font-weight: bold;
        }

        .metodo {
            display: flex;
            margin-bottom: 1vh;
            background: rgb(218, 218, 218);
        }

        .metodo_titulo {
            padding-left: 10px;
            padding-right: 10px;
            font-weight: bold;
        }

        .metodo_descripcion {
            padding-left: 10px;
        }

        .eliminar {
            padding-left: 10px;
        }

        @media screen and (max-width:699px) {
            .btn_nuevo {
                width: 100vw;
            }
        }

        @media screen and (min-width:700px) {
            .contenido {
                width: calc(400px + 30vw);
                margin-left: calc((100vw - (400px + 30vw))/2);
                margin-right: calc((100vw - (400px + 30vw))/2);
            }
        }
    </style>

</head>

<body>
    <div id="TopBar">
        <div class="container">
            <div class="row">
                <div onclick="window.location.href='index.html'" class="col-12 LOGO">
                    UNITED MARKETS
                </div>
            </div>
            <div class="row">
                <div class="col-3" style="text-align: right;">
                    <a href="micuenta.html" class="btn btn-outline-light usuario">
                        Mi Cuenta
                    </a>
                </div>
                <div class="col-6">
                    <input type="search" class="form-control BUSCADOR" placeholder="Buscar productos">
                </div>
                <div class="col-3">
                    <a href="micarrito.html"><img src="documentos/imagenes/iconos/carrito.png"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="contenido">
        <div class="titulos">
            Editar Direccion
        </div>
        <hr>
        <?php
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');
        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        $datosql = mysqli_query($conexion, "SELECT * FROM `direcciones` WHERE id={$_GET['id']}");
        $datos = mysqli_fetch_assoc($datosql);
        ?>
        <form action="documentos/php/editardireccion.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <label>Nombre completo</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo $datos['nombre'] ?>">
            <br>
            <label>Pais</label>
            <input type="text" class="form-control" name="pais" value="<?php echo $datos['pais'] ?>">
            <br>
            <label>Estado/Provincia/Region</label>
            <input type="text" class="form-control" name="estado" value="<?php echo $datos['estado'] ?>">
            <br>
            <label>Municipio</label>
            <input type="text" class="form-control" name="municipio" value="<?php echo $datos['municipio'] ?>">
            <br>
            <label>Colonia</label>
            <input type="text" class="form-control" name="colonia" value="<?php echo $datos['colonia'] ?>">
            <br>
            <label>Calle y numero</label>
            <input type="text" class="form-control" name="calle" value="<?php echo $datos['calle'] ?>">
            <br>
            <label>Numero</label>
            <input type="text" class="form-control" name="numero_casa" value="<?php echo $datos['numero_casa'] ?>">
            <br>
            <label>Codigo Postal</label>
            <input type="number" class="form-control" name="codigo_postal" value="<?php echo $datos['codigo_postal'] ?>">
            <br>
            <label>Numero de telefono</label>
            <input type="tel" class="form-control" name="telefono" value="<?php echo $datos['telefono'] ?>">
            <br>
            <input type="submit" class="btn btn-primary btn-block btn_nuevo" value="Editar direccion">
            <br>
        </form>
    </div>

</body>

</html>
<script>
    $(".BUSCADOR").on('keyup', function(e) {
        var keycode = e.keyCode || e.which;
        if (keycode == 13) {
            if ($(".BUSCADOR").val() != '') {
                window.location.href = "buscador.php?s=" + $(".BUSCADOR").val();
            }
        }
    });
</script>