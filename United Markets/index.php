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
        }

        .categoria_titulo {
            margin-left: 2vw;
            font-size: 26px;
        }

        .categoria_titulo>a {
            font-size: 20px;
        }

        .productos {
            position: relative;
            overflow-x: auto;
            display: flex;
            flex-direction: row;
            overflow-y: hidden;
            overflow-x: auto;
            /* overflow-x: hidden; */
            /* flex-wrap: wrap; */

        }

        .producto {
            height: 290px;
            width: 230px;
            background: white;
            cursor: pointer;
            margin-left: 2vw;
            margin-top: 2vh;
            border-radius: 10px;
        }

        .producto_imagen {
            width: 230px;
            height: 160px;
            margin-bottom: 10px;
            border-radius: 10px 10px 0 0;
        }

        .producto_titulo {
            padding-left: 10px;
            padding-right: 10px;
            width: 230px;
            height: calc(24px * 2);
            text-overflow: ellipsis;
            overflow: hidden;
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
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                        if (!isset($_SESSION['estatus'])) {
                            echo "<a href=\"login.html\" class='btn btn-outline-light usuario'>Login</a>";
                        } else {
                            echo "<a href=\"micuenta.php\" class='btn btn-outline-light usuario'>Mi Cuenta</a>";
                        }
                    }
                    ?>
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
        <?php
        $conexion = mysqli_connect('localhost', 'root', '', 'united_markets');
        if ($conexion->connect_error) {
            die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
        }
        $gruposql = mysqli_query($conexion, "SELECT categoria FROM productos GROUP BY categoria");
        if ($gruposql->num_rows > 0) {
            while ($grupos = $gruposql->fetch_assoc()) {
                $datos = mysqli_query($conexion, "SELECT id,nombre,precio,entrega,miniatura FROM productos WHERE categoria='{$grupos['categoria']}'");
        ?>
                <div class="categoria">
                    <div class="categoria_titulo">
                        <?php echo $grupos['categoria'] ?>
                    </div>
                    <div class="productos">
                        <?php
                        if ($datos->num_rows > 0) {
                            while ($row = $datos->fetch_assoc()) {
                        ?>
                                <div class="producto" onclick="window.location.href='producto.php?id=<?php echo $row['id'] ?>'">
                                    <img src="documentos/imagenes/productos/<?php echo $row['miniatura'] ?>" class="producto_imagen">
                                    <div class="producto_titulo">
                                        <?php echo $row['nombre'] ?>
                                    </div>
                                    <div class="producto_precio">
                                        $<?php echo $row['precio'] ?>
                                    </div>
                                    <div class="producto_entrega">
                                        <?php echo $row['entrega'] ?>
                                    </div>
                                </div>

                <?php
                            }
                        }
                        echo "</div></div>";
                    }
                } ?>

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