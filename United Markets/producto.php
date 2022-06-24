<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$conexion = mysqli_connect('localhost', 'root', '', 'united_markets');
if ($conexion->connect_error) {
    die("Fallo la conexion al servidor, error: " . $conexion->connect_error);
}
$sql = mysqli_query($conexion, "SELECT * FROM productos WHERE id={$_GET['id']}");
$productodatos = mysqli_fetch_assoc($sql);

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
            overflow-x: hidden;
        }

        #TopBar {
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
            display: flex;
            justify-content: center;
        }

        @media screen and (max-width:700px) {
            .producto {
                width: fit-content;
                display: unset;
            }

            .producto_imagen {
                width: 90vw;
                height: 90vw;
            }

            .producto_titulo {
                width: 90vw;
            }
        }

        @media screen and (min-width:699px) {
            .producto {
                width: fit-content;
                display: flex;
            }

            .producto_imagen {
                width: 400px;
                height: 300px;
            }

            .btn_comprar {
                width: calc(400px + 30vw);
                margin-left: calc((100vw - (400px + 30vw))/2);
                margin-right: calc((100vw - (400px + 30vw))/2);
            }

            hr {
                width: calc(400px + 30vw);
                margin-left: calc((100vw - (400px + 30vw))/2);
                margin-right: calc((100vw - (400px + 30vw))/2);
            }

            .productos_relacionados,
            .productos_rel_titulo,
            .comentarios {
                width: calc(400px + 30vw);
                margin-left: calc((100vw - (400px + 30vw))/2);
                margin-right: calc((100vw - (400px + 30vw))/2);
            }

            .producto_titulo {
                width: 30vw;
            }
        }

        .producto_datos {
            padding-top: 2vh;
        }

        .producto_imagen {
            margin-left: 2vw;
            margin-right: 2vw;
            padding-top: 2vh;
            margin-bottom: 10px;
        }

        .producto_titulo {
            padding-left: 2vw;
            padding-right: 2vw;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .producto_precio {
            padding-left: 2vw;
            padding-right: 2vw;
            font-weight: bold;
        }

        .producto_entrega {
            padding-left: 2vw;
            padding-right: 2vw;
            font-weight: bold;
            color: rgb(0, 134, 7);
        }

        .productos_relacionados {
            position: relative;
            overflow-x: auto;
            display: flex;
            flex-direction: row;
            overflow-y: hidden;
            overflow-x: auto;

        }

        .producto_rel {
            height: 290px;
            width: 230px;
            background: white;
            cursor: pointer;
            margin-right: 2vw;
            margin-top: 2vh;
            border-radius: 10px;
        }

        .producto_imagen_rel {
            width: 230px;
            height: 170px;
            margin-bottom: 10px;
            border-radius: 10px 10px 0 0;
        }

        .producto_titulo_rel {
            padding-left: 10px;
            padding-right: 10px;
            width: 230px;
            height: calc(24px * 2);
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .producto_precio_rel {
            padding-left: 10px;
            font-weight: bold;
        }

        .producto_entrega_rel {
            padding-left: 10px;
            font-weight: bold;
            color: rgb(0, 134, 7);
        }

        .productos_rel_titulo {
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
                    <?php
                    if (!isset($_SESSION['estatus'])) {
                        echo "<a href=\"login.html\" class='btn btn-outline-light usuario'>Login</a>";
                    } else {
                        echo "<a href=\"micuenta.php\" class='btn btn-outline-light usuario'>Mi Cuenta</a>";
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
        <div class="producto">
            <img src="documentos/imagenes/productos/<?php echo $productodatos['miniatura'] ?>" class="producto_imagen">
            <div class="producto_datos">
                <div class="producto_titulo">
                    <?php echo $productodatos['nombre'] ?>
                </div>
                <div class="producto_precio precio">
                    <?php echo "$" . $productodatos['precio'] ?>
                </div>
                <div class="producto_entrega">
                    <?php echo $productodatos['entrega'] ?>
                </div>
                <div class="producto_precio">
                    Cantidad
                    <input type="number" id="cantidad" onchange="cambiarPrecio()" value="1" style="text-align: center;" min="1" max="99">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <button onclick="agregarCarrito()" class="btn btn-warning btn-block btn_comprar">Añadir al carrito</button>
    <button onclick="comprar(<?php echo $productodatos['id'] ?>)" class="btn btn-success btn-block btn_comprar">Comprar Ahora</button>
    <hr>
    <div class="productos_rel_titulo">
        Productos relacionados
    </div>
    <div class="productos_relacionados">
        <?php
        $datos = mysqli_query($conexion, "SELECT * FROM `productos` WHERE nombre LIKE '%{$productodatos['nombre']}%' ");
        if ($datos->num_rows > 0) {
            while ($row = $datos->fetch_assoc()) {
        ?>
                <div class="producto_rel" onclick="window.location.href='producto.php?id=<?php echo $row['id'] ?>'">
                    <img src="documentos/imagenes/productos/<?php echo $row['miniatura'] ?>" class="producto_imagen_rel">
                    <div class="producto_titulo_rel">
                        <?php echo $row['nombre'] ?>
                    </div>
                    <div class="producto_precio_rel">
                        $<?php echo $row['precio'] ?>
                    </div>
                    <div class="producto_entrega_rel">
                        <?php echo $row['entrega'] ?>
                    </div>
                </div>
        <?php
            }
        } ?>

    </div>
    <hr>
    <br>
</body>

</html>

<script>
    function agregarCarrito() {
        $.ajax({
            type: 'POST',
            url: 'documentos/php/agregarCarrito.php',
            data: "id=" + <?php echo $productodatos['id'] ?>,
            success: function() {}
        });
    }

    function cambiarPrecio() {
        precio_base = <?php echo $productodatos['precio'] ?>;
        $('.precio').text("$" + $('#cantidad').val() * precio_base);
    }

    function comprar(id) {
        if (confirm("¿ Esta segur@ de comprar este producto ?")) {
            $.ajax({
                type: 'POST',
                url: 'documentos/php/comprar.php',
                data: "id=" + id + "&cantidad=" + $('#cantidad').val(),
                success: function() {
                    window.location.href = 'pedidos.php'
                }
            });
        }
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