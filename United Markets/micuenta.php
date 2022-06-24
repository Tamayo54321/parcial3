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
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .acceso {
            display: flex;
            width: 300px;
            background: rgb(255, 255, 255);
            margin-top: 4vh;
            cursor: pointer;
        }

        .acceso_icono {
            width: 80px;
            height: 80px;
        }

        .acceso_titulo {
            padding-left: 30px;
            padding-top: 20px;
            font-size: 20px;
            font-weight: bold;
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
                    <a href="micuenta.php" class='btn btn-outline-light usuario'>Mi Cuenta</a>
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
        <div class="acceso" onclick="window.location.href='pedidos.php'">
            <img src="documentos/imagenes/iconos/paquete.png" alt="" class="acceso_icono">
            <div class="acceso_titulo">
                Mis Pedidos
            </div>
        </div>
        <div class="acceso" onclick="window.location.href='micarrito.php'">
            <img src="documentos/imagenes/iconos/carrito_black.png" alt="" class="acceso_icono">
            <div class="acceso_titulo">
                Mi Carrito
            </div>
        </div>
        <div class="acceso" onclick="window.location.href='direcciones.php'">
            <img src="documentos/imagenes/iconos/home.png" alt="" class="acceso_icono">
            <div class="acceso_titulo">
                Direcciones
            </div>
        </div>
        <div class="acceso" onclick="window.location.href='metodosdepago.php'">
            <img src="documentos/imagenes/iconos/tarjeta.png" alt="" class="acceso_icono">
            <div class="acceso_titulo">
                Metodos De Pago
            </div>
        </div>
        <div class="acceso" onclick="window.location.href='editarcuenta.html'">
            <img src="documentos/imagenes/iconos/configuracion.png" alt="" class="acceso_icono">
            <div class="acceso_titulo">
                Editar Cuenta
            </div>
        </div>
        <div class="acceso" onclick="window.location.href='misproductos.php'">
            <img src="documentos/imagenes/iconos/paquete.png" alt="" class="acceso_icono">
            <div class="acceso_titulo">
                Mis Productos
            </div>
        </div>
        <div class="acceso" onclick="window.location.href='documentos/php/cerrarSesion.php'">
            <img src="documentos/imagenes/iconos/cerrar_sesion.png" alt="" class="acceso_icono">
            <div class="acceso_titulo">
                Cerrar Sesion
            </div>
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