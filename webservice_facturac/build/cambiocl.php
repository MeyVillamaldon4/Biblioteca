<?php
session_start();
//header ('Content-Type: application/json');

require_once("../config/Conectar.php");
require "../model/Funciones.php";
include '../includes/cabeceraLogin.php';

?>
<style>
  
@media (min-width: 1125px) {
    .color-side2 {
        position: absolute;
        right: 0;
        top: 130px;
        width: 200px;
        min-height: 100vh;
        background: rgb(255,255,255);
background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(201,209,255,0.8750967492260062) 51%);
    }
 
}

@media (min-width: 1200px) {
    .color-side2 {
        width: 275px;
    }

}

@media (min-width: 1680px) {
    .color-side2 {
        width: 450px;
    }
}

</style>

<link rel="stylesheet" href="../includes/style.css">

<div class="containerG">

    <div id="img" class="img">
        <img class="img-side" src="../includes/img/sapiens2.svg" alt="">
    </div>


    <div class="divCambioClave">
        <h3>Recuperacion de clave</h3>
        <hr style="border: 1px solid grey; width:85%; margin-bottom: 50px; ">
        <form autocomplete="off" action="" method="POST" class="formCambioClave">

            <label for="">Ingrese nueva clave</label>
            <input type="password" name="password" id="password">
            <input type="submit" name="nuevaclave">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevaclave'])) {
            //verificar el usuario ok de pagina anterior
            if (!isset($_SESSION['usuario'])) {
                header("Location: login.php");
                exit();
            }
            //capturar usuario
            $usuario = $_SESSION['usuario'];
              // Verificar que se haya ingresado una contraseña nueva
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
      // Instanciar objeto Funciones para validar usuario
            $validarUs = new Funciones();
            $validarUsuario = $validarUs->get_user($usuario);
            if ($validarUsuario) {
                echo "<script>alert('Cambio de clave realizado, Inicie sesion!');</script>";
                // Usuario válido, proceder con el cambio de clave
            
              /* echo "<pre>";
               var_dump($usuario);
               var_dump($clave);
               echo "</pre>";*/
               $cambioCl = new Funciones();
               $cambioClave = $cambioCl->update_clave($usuario, $password);
               
               header("Location: ../build/login.php ");

            } else {
                 echo "<script>alert('No se pudo cambiar la clave');</script>";
            }
        } else {
            echo "<script>alert('Por favor, complete todos los campos');</script>";
        }
    }
        ?>

    </div>
    <!--cambiar disabled de preg verif al dar click 
        <script>
            function panelVerificacion() {
                let mostrarPregverif = document.getElementById("preguntaVerificacion");
                mostrarPregverif.style.display = 'block';
            }
        </script>  -->

    <!--color de la derecha  -->
    <div class="color-side2"> </div>
</div>