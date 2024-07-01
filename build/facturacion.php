<?php
include '../includes/cabecera.php';
require_once("../config/Conectar.php");
require "../model/Funciones.php";

$pagar = 0;
?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    h2 {
        padding-top: 55px;
    }

    .facturación {
        /*pinta de abajo hacia arriba el item*/
        background: linear-gradient(to top, orange 10%, transparent 90%);
    }

    .datosCliente {
        width: 500px;
        padding: 50px;
        margin: 0 auto;


    }

    .formCliente {
        display: flex;
        flex-direction: column;
        background-color: #dcdcdc;
        text-align: center;
        border: 1px solid grey;
        padding: 50px;
    }

    input,
    label {
        margin-bottom: 4px;
        margin-top: 4px;
        height: 25px;
    }

    .title {
        text-decoration: underline;
    }

    hr {
        width: 400px;
    }

    .btn-registro {
        margin-top: 10px;
        color: #000000;
        border: 2px solid #fda605;
        border-radius: 0px;
        padding: 18px 36px;
        display: inline-block;
        font-family: "Lucida Console", Monaco, monospace;
        font-size: 14px;
        letter-spacing: 1px;
        cursor: pointer;
        box-shadow: inset 0 0 0 0 #fda605;
        -webkit-transition: ease-out 0.4s;
        -moz-transition: ease-out 0.4s;
        transition: ease-out 0.4s;
        margin-top: 20px;
        margin-bottom: 50px;
        height: 50px;
    }

    .btn-registro:hover {
        box-shadow: inset 0 100px 0 0 #fda605;
        font-weight: bold;

    }
</style>
</head>

<body>
    <h2>Libros Seleccionados</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>cantidad</th>
                <th>total</th>
                <th>stock disponible</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Verificar si se recibió el parámetro 'datos' en la URL
           
            if (isset($_GET['datos'])) {
                // Decodificar el JSON recibido
                $datosJSON = urldecode($_GET['datos']);
                $miArreglo = json_decode($datosJSON, true); // Convertir JSON a arreglo PHP

                // Verificar si la decodificación fue exitosa
                if ($miArreglo === null && json_last_error() !== JSON_ERROR_NONE) {
                    die('Error al decodificar los datos JSON');
                }

                // Mostrar los datos del arreglo

                foreach ($miArreglo as $elemento) { ?>
                    <tr>
                        <td><?php echo  $elemento['nombre']; ?></td>
                        <td><?php echo  $elemento['autor']; ?></td>
                        <td><?php echo  $elemento['precio']; ?></td>
                        <td><?php echo  $elemento['stock']; ?></td>
                        <td><?php echo  $elemento['cantidad'] ?></td>

                        <td><?php

                            $nCantidad = (float)$elemento['cantidad'];
                            $nprecio = $elemento['precio'];
                            $total = $nprecio * $nCantidad;
                            $pagar += $total;
                            echo $total;


                            /*echo $elemento['precio'];
                           echo var_dump((float)$elemento['precio']);
                           echo var_dump((float)$elemento['cantidad']);
                            */
                            ?></td>

                        <td style="background-color: grey; color:white; text-align:center;">
                            <?php
                            $nstock = (float)$elemento['stock'];
                            $darBaja = $nstock - $nCantidad;

                            if ($darBaja < 0) {
                                echo "No hay stock disponible";
                            } else {
                                echo $darBaja;
                            }


                            ?></td>
                    <?php } ?>
                    </tr>
                <?php } ?>

        </tbody>
    </table>


    <div class="datosCliente">
        <form action="" method="post" class="formCliente">
            <h3 class=title>Facturación </h3>
            <?php setlocale(LC_TIME, 'es_ES.UTF-8');
            echo date("d-M-Y");
            ?>
            <hr style="border: 1px solid grey;">
            <label for="" name="cedula">Cedula</label><input id="cedula" name="cedula" type="text" pattern="\d+" title="Debe ser un número positivo" required>
            <label for="" name="cliente">Nombre del cliente</label> <input name="cliente" type="text">
            <label for="">Total a pagar </label><strong><?php echo "$" . $pagar; ?></strong>
            <input class="btn-registro" type="submit" value="registrar compra">



            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Validar y capturar datos del formulario
                $cedula = $_POST['cedula'];
                $cliente = $_POST['cliente'];
                $total = $pagar;

                // Insertar factura en la base de datos
                $ingresofact = new Funciones();  // Suponiendo que Funciones es tu clase para manejar la BD
                $ingresarfact = $ingresofact->insert_factura($cedula, $cliente, $total);
                
                if ($ingresarfact) {
                    echo "<script>alert('Datos mal ingresados');</script>";
                } else {
                    echo "<script>alert('Registro de factura exitoso');</script>";
                    // Actualizar el stock en la base de datos
                    foreach ($miArreglo as $elemento) {
                        $id = $elemento['id'];  // Asegúrate de tener el ID único del producto
                        $stock = $darBaja; //asigno el valor nuevo a stock
                        $ingresostock = new Funciones();  // llamo la funcion
                        //modifico el stock
                        $modificarStock = $ingresofact->update_stock($id, $stock);
                    }
                    //usar en caso q de error el header x redireccionamiento
                    echo '<script>window.location.href = "../build/ordenCompra.php";</script>';
                }
            }

            ?>

    </div>

</body>