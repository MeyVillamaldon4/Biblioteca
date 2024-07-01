<?php
session_start();
//header ('Content-Type: application/json');

require_once("../config/Conectar.php");
require "../model/Funciones.php";
include '../includes/cabeceraLogin.php';

?>
<link rel="stylesheet" href="../includes/style.css">

<body>

    <!-- recuperar clave -->
    <div class="containerG">
        <div id="img" class="img">
            <img class="img-side" src="../includes/img/sapiens.svg" alt="">
        </div>


        <div id="preguntaVerificacion" class="preguntaVerificacion">
            <form autocomplete="off" action="" id="formRecuperar" class="formRecuperar" method="post">
                <h3>Pregunta de recuperaciòn</h3>
                <label for="">Ingrese su usuario</label>
                <input type="text" placeholder="Usuario" id="usuario" name="usuario">
                <label for="">Ingrese nombre de su Mascota</label>
                <input type="password" id="PVmascota" name="PVmascota">
                <input id="" class="btn-log" type="submit" value="Verificar">
            </form>

            <?php
            //validar post y verificar lo ingresado
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               
                    //capturar dato 
                    $usuario = $_POST['usuario'];
                    $PVmascota = $_POST['PVmascota'];

                    //llamo la funcion y verifica los datos del bd
                    $consultapv = new Funciones();
                    $modificarclave = $consultapv->verificar_pv($usuario, $PVmascota);

                    if ($modificarclave) {
                        $_SESSION['usuario'] =  $usuario;
                        echo "<script>alert('credenciales ok para modificar clave');</script>";
                        header("Location: cambiocl.php ");
                    } else {
                        echo "<script>alert('Error de credenciales');</script>";
                    } 
                }
            
            ?>
    <div class="color-side"></div>   
</div>       

