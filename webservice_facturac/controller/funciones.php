<?php
//llamo ambos
header ('Content-Type: application/json');

require_once ("../config/Conectar.php");
require_once ("../model/Funciones.php");

//iniciamos la clase categoria

$funcion=new Funciones();
$body = json_decode(file_get_contents("php://input"),true);
//libros
switch ($_GET["op"]) {
    //obtener todos los datos 
    case 'GetAll':
                        //nombre de funct de model_Categoria
        $datos=$funcion->get_dato();
        echo json_encode($datos);
    break;
   //mostrar por id 
    case 'GetId':
        $datos=$funcion->get_dato_x_id($body["id"]);
        echo json_encode($datos);
    break;
     //insertar datos 
    case 'Insertar':
        $datos=$funcion->insert_dato($body["nombre"],$body["autor"],$body["precio"],$body["stock"]);
        echo "item añadido";
    break;
      //actualizar datos 
    case 'Actualizar':
        $datos=$funcion->update_dato($body["id"],$body["nombre"],$body["autor"],$body["precio"],$body["stock"]);
        echo "Actualizacion ok";
    break;
    //modificar datos del item/
    case 'BorrarStock':
        $datos=$funcion->delete_dato($body["id"]);
        echo "Borrado ok  (modificacion de stock)";
    break;
    
    //borar todo el item
    case 'BorrarItem':
        $datos=$funcion->deleteAllItem_dato($body["id"]);
        echo "Borrado del item completo";
    break;
   
        //usuarios
    //obtener todos los datos 
    case 'GetAllUser':
                        //nombre de funct de model_Categoria
        $datos=$funcion->get_Alluser();
        echo json_encode($datos);
    break;
   //mostrar por id 
    case 'GetUser':
        $datos=$funcion->get_user($body["usuario"]);
        echo json_encode($datos);
    break;
     //insertar datos 
    case 'InsertarUser':
        $datos=$funcion->insert_user($body["usuario"],$body["password"]);
        echo "usuario añadido";
    break;
      //actualizar clave
    case 'ActualizarClave':
        $datos=$funcion->update_clave($body["usuario"],$body["password"]);
        echo "Actualizacion ok";
    break;
    //borar todo el item
    case 'BorrarUser':
        $datos=$funcion->delete_user($body["usuario"]);
        echo "Borrado del item completo";
    break;
   

}





//url de consulta en postmanCON LA BD
//http://localhost/webservice_facturac/controller/funciones.php?op=GetAll
//  http://localhost/webservice_postman/controller/categoria.php?op="se coloca el case a realizar"
//en get para consultar y post para modificar o eliminar
?>
