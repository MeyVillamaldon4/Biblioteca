<?php
// Iniciar la sesión si no está iniciada
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redireccionar a la página de inicio de sesión (o cualquier otra página)
header("Location: ../index.php");
exit();
?>