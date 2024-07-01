<?php
session_start();
//header ('Content-Type: application/json');

require_once("config/Conectar.php");
require "model/Funciones.php";
?>

<head>
<link rel="stylesheet" href="includes/style.css">
</head>
<body>
 
<body>
    <!--  login -->
    <div class="contenedor">
        <div class="login">
            <form action="" class="form" method="POST">
                <h2>Iniciar Sesión</h2>
                <label for="">Usuario</label>
                <input type="text" placeholder="Usuario" id="usuario" name="usuario">
                <label for=""> Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Contraseña">
                <input class="btn-log" type="submit" value="LOGIN">
                <a class="recuperar" href="build/recuperar.php">Olvide clave</a>
            </form>
        </div>
    </div>
</body>

<?php
//validar post// de usuario ok
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        //capturar dato 
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        //llamo la funcion y verifica los datos del bd
        $consulta = new Funciones();
        $mostrar = $consulta->verificar($usuario, $password);
        /* //muestra el arreglo
            echo "<pre>";
            var_dump($mostrar);
            echo "</pre>";
            */
        //valida el arreglo
        if ($mostrar) {
            $_SESSION['usuario'] =  $usuario;
            echo "<script>alert('Ingreso exitoso.');</script>";
            header("Location: build/ordenCompra.php ");
            exit();
           
        } else {
            echo "<script>alert('Error de credencial');</script>";
           
        }
    }
}
?>

