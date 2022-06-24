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

            .metodos,
            .titulos {
                width: calc(400px + 30vw);
                margin-left: calc((100vw - (400px + 30vw))/2);
                margin-right: calc((100vw - (400px + 30vw))/2);
            }

            .metodo_titulo {
                width: calc((400px + 30vw) - 160px);
            }
        }
    </style>

</head>

<body>
    <div id="TopBar">
        <div class="container">
            <div class="row">
                <div onclick="window.location.href='index.php'" class="col-12 LOGO">
                    UNITED MARKETS
                </div>
            </div>
            <div class="row">
                <div class="col-3" style="text-align: right;">
                    <a href="micuenta.php" class="btn btn-outline-light usuario">
                        Mi Cuenta
                    </a>
                </div>
                <div class="col-6">
                    <input type="search" class="form-control BUSCADOR" placeholder="Buscar productos">
                </div>
                <div class="col-3">
                    <a href="micarrito.php"><img src="documentos/imagenes/iconos/carrito.png"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="contenido">
        <div class="titulos">
            Metodos de pago
        </div>
        <hr>
        <div class="metodos">
            <?php
            $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');
            if ($conexion->connect_error) {
                die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
            }
            $datos = mysqli_query($conexion, "SELECT id,numero, vencimiento FROM `metodos_pago` WHERE id_cliente={$_SESSION['id']}");
            if ($datos->num_rows > 0) {
                while ($row = $datos->fetch_assoc()) {
            ?>
                    <div class="metodo">
                        <div class="container">
                            <div class="row metodo_titulo">
                                Visa que termina en <?php echo substr($row['numero'], -4) ?>
                            </div>
                            <div class="row metodo_descripcion">
                                Expira en <?php echo $row['vencimiento'] ?>
                            </div>
                            <div class="row">
                                <a href="documentos/php/eliminarTarjeta.php?id=<?php echo $row['id'] ?>" class="eliminar">Eliminar</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } ?>

            <a href="nuevoMetodo.html" class="btn btn-primary btn-block btn_nuevo">Añadir nuevo metodo de pago</a>
        </div>
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