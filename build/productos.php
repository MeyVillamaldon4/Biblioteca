<?php

require_once("../config/Conectar.php");
require "../model/Funciones.php";
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;

    }

    th {
        background-color: #f2f2f2;
    }

    h2 {
        padding-top: 50px;
        text-align: end;
        color: orange;
    }

    .productos {
        /*pinta de abajo hacia arriba el item*/
        background: linear-gradient(to top, orange 10%, transparent 90%);
    }

    .btnComprar {
        background-color: #4CAF50;
        padding: 15px;
        margin: 50px;
        font-size: 20px;
        border: 1px solid black;
        border-radius: 10px;
        cursor: pointer;
    }

    .cantidad {
        width: 50px;
    }

    .btn {
        border: none;
    }
</style>

<body>

    <?php
    include '../includes/cabecera.php';
    ?>

    <h2>REABASTECIMIENTO</h2>
    <hr style="border: 1px solid #ccc;">

    <form action="" class="buscador" method="post">
        <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del libro">
        <input type="submit" id="buscarLibro" name="buscarLibro" value="Buscar - mostrar">
    </form>
    <!-- mostrar solo libro buscado -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        //llamar la funcion
        $buscar = new Funciones();
        $buscarLibro =  $buscar->get_dato_libro($nombre);
        if ($buscarLibro) {
    ?>
            <table id="tabla-productos">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Precio</th>
                        <th>Stock actual</th>
                        <th>añadir cantidad</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    //CAPTAR DATO de arreglo

                    foreach ($buscarLibro as $libro) : ?>

                        <tr>
                            <!--  mostrar el arreglo 1x1   -->
                            <td class="item-id"><?php echo $libro['id']; ?></td>
                            <td class="item-nombre"><?php echo $libro['nombre']; ?></td>
                            <td class="item-autor"><?php echo $libro['autor']; ?></td>
                            <td class="item-precio"><?php echo $libro['precio']; ?></td>
                            <td class="item-stock"><?php echo $libro['stock']; ?></td>
                            <!-- minimo uno automatico al dar clck en flecha  -->
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id_libro" value="<?php echo $libro['id']; ?>">
                                    <input type="hidden" name="stock_actual" value="<?php echo $libro['stock']; ?>">
                                    <input type="number" name="addStock" class="addStock" min="1" required>
                                    <input type="submit" name="nuevostock" value="Añadir">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
    <?php
        } else {
            echo "No se encontraron libros.";
        } //cierre de if buscar
    }



    if (isset($_POST['nuevostock'])) {


        // Validar y capturar datos 
        $id = $_POST['id_libro'];
        $cantidadnum = isset($_POST['addStock']) ? (int)$_POST['addStock'] : 0; // Check if addStock is set];
        $stock = (int)$_POST['stock_actual'];
        $nuevo_stock = $stock + $cantidadnum;

        /*
        echo"stock". var_dump($stock);
        echo"ingresar". var_dump($cantidadnum);
        echo"total". var_dump($nuevo_stock);
        */

        $verificar = new Funciones();
        $verificarLibro = $verificar->get_dato_x_id($id);
        if ($verificarLibro) {
            echo "<script>alert('Stock actualizado correctamente');</script>";
            $modificar = new Funciones();
            $modificarStock = $modificar->update_stock($id, $nuevo_stock);
        } else {
            echo "<script>alert('Error al actualizar el stock');</script>";
        }
    }


    ?>

    <button onclick="MostrarRegistro()" id="btnRegistro">Registrar Libro</button>
    <script>
        function MostrarRegistro() {
            let mostrarRegistro = document.getElementById("form");
            let ocultarbtnRegistro = document.getElementById("btnRegistro");
            let ocultarPanelPrincipal = document.getElementById("buscador");
            mostrarRegistro.style.display = 'block';
            ocultarbtnRegistro.style.display = 'none';
            locultarPanelPrincipal.style.display = 'none';

        }
    </script>

    <form id="form" action="" method="post" style="display:none;">
        <h3>Registrar Nuevo libro</h3>
        <input type="text" name="titulo" placeholder="Titulo del libro" required>
        <input type="text" name="autor" placeholder="Autor del libro" required>
        <input type="text" name="precio" placeholder="Precio" required>
        <input type="text" name="stock" placeholder="Stock del libro" required>
        <input type="submit" name="registrarLibro" value="REGISTRAR">
    </form>
    <?php
    if (isset($_POST['registrarLibro'])) {

        // Validar y capturar datos 
        $nombre = ucfirst(strtolower($_POST['titulo']));
        $autor = ucfirst(strtolower($_POST['autor']));
        $precio = ucfirst(strtolower($_POST['precio']));
        $stock =ucfirst(strtolower( $_POST['stock']));
        // Validar datos
        $registrar = new Funciones();
        $registroLibro = $registrar->insert_dato($nombre, $autor, $precio, $stock);
        echo "<script>alert('Item agregado');</script>";
    } else {
        //echo "<script>alert('Error al registrar nuevo item');</script>";
    }
