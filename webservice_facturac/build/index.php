<?php

require_once("../config/Conectar.php");
require "../model/Funciones.php";
?>

<style>
    .disabled {
        display: none;
    }

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

    .home {
        /*pinta de abajo hacia arriba el item*/
        background: linear-gradient(to top, orange 10%, transparent 90%);
    }

    .btnCompra {
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
</style>

<body>

    <?php
    include '../includes/cabecera.php';
    ?>


    <h2>ORDEN DE COMPRA</h2>
    <hr style="border: 1px solid #ccc;">

    <form action="./" method="post">
        <table id="tabla-productos">
            <thead>
                <tr>

                    <th>id</th>
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>cantidad</th>
                    <th>Ok</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    //llamar la funcion
                    $mostrar = new Funciones();
                    $listaLibros =  $mostrar->get_AllDato();

                    ?>
                    <!--  para recorrer el arreglo total del bd  -->
                    <?php foreach ($listaLibros as $index => $libro) : ?>
                        <!--  mostrar el arreglo 1x1   -->
                        <td class="item-id"><?php echo $libro['id']; ?></td>
                        <td class="item-nombre"><?php echo $libro['nombre']; ?></td>
                        <td class="item-autor"><?php echo $libro['autor']; ?></td>
                        <td class="item-precio"><?php echo $libro['precio']; ?></td>
                        <td class="item-stock"><?php echo $libro['stock']; ?></td>
                                                           <!-- minimo uno automatico al dar clck en flecha  -->
                        <td><input id="inputcantidad" class="item-cantidad" type="number" min="1"></td>
                        <td><input type="checkbox" id="item-check" class="check" name="check[]" style="display: none;">Validar</td>
                </tr>


            <?php endforeach; ?>

            </tbody>
        </table>
        <script>
            //al ingresar una cantidad se habilite el check de validacion x c/u
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener todos los elementos de cantidad y checkbox
                const inputsCantidad = document.querySelectorAll('.item-cantidad');
                const checkboxes = document.querySelectorAll('.check');

                //    // Escuchar el evento de entrada en cada campo de cantidad
                inputsCantidad.forEach((input, index) => {
                    input.addEventListener('input', function() {
                        const isChecked = input.value.trim() !== '';
                        const checkbox = input.parentNode.nextElementSibling.querySelector('.check');

                        // Mostrar el checkbox de la misma fila si hay una cantidad ingresada
                        if (isChecked) {
                            checkbox.style.display = 'inline-block';
                        } else {
                            checkbox.style.display = 'none';
                        }
                    });
                });
            });
        </script>


        <input class="btnCompra" type="submit" name="submit" value="Registrar factura">
    </form>

    <script>
        // js para validar cantidad
        const nPositivos = document.querySelector('form');
        nPositivos.addEventListener('submit', function(event) {
            const cantidadInputs = document.querySelectorAll('.cantidad');
            for (let input of cantidadInputs) {
                if (input.value < 0) {
                    alert('La cantidad no puede ser negativa. Por favor, ingrese un número positivo o cero.');
                    event.preventDefault(); // Evita que se envíe el formulario si es negativo
                    return;
                }
            }
        });

        //captar datos al dar check y +1 cantidad
        document.addEventListener('DOMContentLoaded', function() {
            let form = document.querySelector('form');
            //al dar submit cree un evento 
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario por defecto
                //verifica los checks  seleccionados
                let checkboxes = document.querySelectorAll('#tabla-productos .check:checked');
                let datosSeleccionados = [];

                checkboxes.forEach(function(checkbox) {
                    let fila = checkbox.closest('tr');
                    //trim elimina espacios inicio final
                    let id = fila.querySelector('.item-id').textContent.trim();
                    let nombre = fila.querySelector('.item-nombre').textContent.trim();
                    let autor = fila.querySelector('.item-autor').textContent.trim();
                    let precio = fila.querySelector('.item-precio').textContent.trim();
                    let stock = fila.querySelector('.item-stock').textContent.trim();
                    let cantidad = fila.querySelector('.item-cantidad').value;

                    // Verificar que la cantidad sea numérica y mayor o igual a cero
                    if (!isNaN(cantidad) && cantidad >= 0) {
                        //agrego los datos al arreglo
                        datosSeleccionados.push({
                            id: id,
                            nombre: nombre,
                            autor: autor,
                            precio: precio,
                            stock: stock,
                            cantidad: cantidad
                        });
                    }
                    //muestro los datos del arreglo 
                    console.log(datosSeleccionados);
                    // Convertir el arreglo a formato JSON
                    let datosSeleccionadosJson = JSON.stringify(datosSeleccionados);
                    // Codificar el JSON para enviarlo como parámetro en la URL
                    let parametros = encodeURIComponent(datosSeleccionadosJson);
                    //indow.location.href = 'procesar-arreglo.php?datos=' + parametros; 
                    window.location.href = '../build/facturacion.php?datos=' + parametros;

                });

            });

        });
    </script>

    <div>


    </div>


</body>

</html>