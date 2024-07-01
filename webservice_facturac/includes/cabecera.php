<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<style>
      body{
    font-family: "Lucida Console", Monaco, monospace;
    
     }
    
    .contenedor {
        background-color:#fda605;
        height: 100px;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .header h1 {
        color: black;
        margin-right: 20px;
        text-align: center;
    }

    nav {
        background-color: #000000;
        color: #fff;
        padding: 10px 10px;
    }

    .menu {
        list-style-type: none;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .menu li {
        margin-left: 10px;
    }

    .menu li a {
        color: #fff;
        text-decoration: none;
        padding: 10px 15px;
    }
    .menu .usuario a {
       margin-left: 180px;
    }
    a:hover{
        background-color: #fda605;
    }
    .menu-icon {
        display: none;
    }

</style>

<body>
    <div class="contenedor">
        <div class="app">
            <header class="header">
                <h1> E-book </h1>
                <nav>
                    <label for="menu-toggle" class="menu-icon">&#9776;</label>
                    <ul class="menu">
                        <li><a class="home" href="../build/index.php">Home</a></li>
                        <li><a class="facturación" href="../build/facturacion.php">Facturación</a></li>
                        <li><a  class="productos" href="../build/productos.php">Mis productos</a></li>
                        <li><a class="salir" href="../build/salir.php">salir</a></li>
                        <li class="usuario"><a href="#">
                                <?php
                                session_start();

                                if (!isset($_SESSION['usuario'])) {
                                    header("Location: login.php");
                                    exit();
                                }
                                //mostrar dato guardado del login
                                echo "Bienvenido " . $_SESSION['usuario'];
                                ?>
                            </a></li>
                    </ul>
                </nav>
            </header>
        </div>
    </div>
</body>

</html>