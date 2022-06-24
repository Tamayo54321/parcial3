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

        .producto {
            display: flex;
            margin-bottom: 1vh;
            background: rgb(218, 218, 218);
        }

        .producto_titulo {
            padding-left: 10px;
            padding-right: 10px;
            height: calc(24px * 3);
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .producto_estrellas {
            padding-left: 10px;
        }

        .producto_precio {
            padding-left: 10px;
            font-weight: bold;
        }

        .producto_entrega {
            padding-left: 10px;
            font-weight: bold;
            color: rgb(0, 134, 7);
        }

        .subtotal {
            text-align: right;
            font-weight: bold;
        }

        .eliminar {
            padding-left: 10px;
        }

        @media screen and (max-width:699px) {
            .producto_imagen {
                width: 120px;
                height: 140px;
                border-radius: 10px;
            }

            .btn_comprar {
                width: 100vw;
            }
        }

        @media screen and (min-width:700px) {
            .producto_imagen {
                width: 180px;
                height: 160px;
                border-radius: 10px;
            }

            .productos,
            .titulos {
                width: calc(400px + 30vw);
                margin-left: calc((100vw - (400px + 30vw))/2);
                margin-right: calc((100vw - (400px + 30vw))/2);
            }

            .producto_titulo {
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
        <div class="titulos">
            Mi Carrito
        </div>
        <hr>
        <div class="productos">
            <?php
            $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');
            if ($conexion->connect_error) {
                die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
            }
            $datos = mysqli_query($conexion, "SELECT p.* FROM `carrito` c, `productos` p WHERE c.id_cliente={$_SESSION['id']} AND c.id_producto=p.id ");
            $precio = 0;
            $productostotal = 0;
            if ($datos->num_rows > 0) {
                while ($row = $datos->fetch_assoc()) {
            ?>
                    <div class="producto">
                        <img src="documentos/imagenes/productos/<?php echo $row['miniatura'] ?>" alt="" class="producto_imagen">
                        <div class="container">
                            <div class="row producto_titulo">
                                <?php echo $row['nombre'] ?>
                            </div>
                            <div class="row producto_precio precio_1">
                                <?php echo "$" . $row['precio'] ?>
                            </div>
                            <div class="row producto_entrega">
                                <?php echo $row['entrega'] ?>
                            </div>
                            <div class="row">
                                <a href="#" onclick="eliminar(<?php echo $row['id'] ?>)" class="eliminar">Eliminar</a>
                            </div>
                        </div>
                    </div>
            <?php
                    $precio += floatval($row['precio']);
                    $productostotal++;
                }
            }
            echo "<div class='subtotal'>
            Subtotal ( " . $productostotal . " Productos ): $" . $precio . "</div>";
            ?>

            <button onclick="window.location.href='comprar.php'" class="btn btn-warning btn-block btn_comprar">Comprar Ahora</button>
        </div>
    </div>

</body>

</html>
<script>
    function eliminar(id) {
        $.ajax({
            type: 'POST',
            url: 'documentos/php/eliminarCarrito.php',
            data: "id=" + id,
            success: function() {
                window.location.href = 'micarrito.php';
            }
        });
    }
</script>
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