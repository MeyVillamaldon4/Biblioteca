<?php
//se le añade la clase conectar de config-conex
class Funciones extends Conectar
{
    //obtener todas los datos -libros
    public function get_dato()
    {
        //CONECTA LA BD
        $conectar = parent::conexion();
        parent::set_name();
		//consulta sql
        $sql = "SELECT * FROM libros";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        //ME MUESTRA EN POSTMAN LOS DATOS DE LA BD EN JSON BODY >PRETTY>JSON
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

   //obtener todos los datos -libros no necesita parametros se los llama con el array
   public function get_AllDato()
   {
       //CONECTA LA BD
       $conectar = parent::conexion();
       parent::set_name();
       //consulta sql
       $sql = "SELECT * FROM libros";
       $sql = $conectar->prepare($sql);
       $sql->execute();
   //
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }


    //funcion q obtiene datos x id
    public function get_dato_x_id($id)
    {
        //CONECTA LA BD
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "SELECT * FROM libros WHERE id= ?";
        $sql = $conectar->prepare($sql);
        $sql->bindParam(1, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_dato_libro($nombre)
    {
        //CONECTA LA BD
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "SELECT * FROM libros WHERE nombre LIKE ?";
        $sql = $conectar->prepare($sql);
        $nombre_like = "%{$nombre}%";
        $sql->bindParam(1, $nombre_like);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }



   //funcion q inserta nuevo item 
      public function insert_dato($nombre,$autor,$precio,$stock)
    {
        //CONECTA LA BD
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "INSERT INTO libros (id,nombre, autor, precio, stock) VALUES (NULL, ?, ?, ?, ?);";
        $sql = $conectar->prepare($sql);
        //insertar las categorias 
     
        $sql->bindParam(1, $nombre);
        $sql->bindParam(2, $autor);
        $sql->bindParam(3, $precio);
        $sql->bindParam(4, $stock);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    //funcion modificar datos x id
    public function update_dato($id,$nombre,$autor,$precio,$stock)
    {
        //CONECTA LA BD
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "UPDATE libros SET nombre =?,autor = ?,precio = ?, stock = ? WHERE id = ?";
        $sql = $conectar->prepare($sql);
        //insertar las categorias 
       
        $sql->bindParam(1, $nombre);
        $sql->bindParam(2, $autor);
        $sql->bindParam(3, $precio);
        $sql->bindParam(4, $stock);
        $sql->bindParam(5, $id);
        $sql->execute();
       
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
      //funcion q obtiene datos stock x id
      public function update_stock($id,$stock)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          $sql = "UPDATE libros SET stock = ? WHERE id = ?";
          $sql = $conectar->prepare($sql);
          //insertar las categorias 
          $sql->bindParam(1, $stock);
          $sql->bindParam(2, $id);
          $sql->execute();
         
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      }
    //no se eliminara el registro solo se cambiara el estado a 0
    public function delete_dato($id)
    {
        //CONECTA LA BD
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "UPDATE libros SET stock = '0' WHERE id = ?";
        $sql = $conectar->prepare($sql);
        //insertar las categorias 
        $sql->bindParam(1, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    } 
    //borra todo el item
    public function deleteAllItem_dato($id)
    {
        //CONECTA LA BD
        $conectar = parent::conexion();
        parent::set_name();
        //funcion a realizar
        $sql = "DELETE FROM libros WHERE id = ?";
        $sql = $conectar->prepare($sql);
        //insertar las categorias 
        $sql->bindParam(1, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    } 

//usuarios

      //obtener todas los datos usuarios
      public function get_Alluser()
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          //consulta sql
          $sql = "SELECT * FROM usuarios";
          $sql = $conectar->prepare($sql);
          $sql->execute();
          //ME MUESTRA EN POSTMAN LOS DATOS DE LA BD EN JSON BODY >PRETTY>JSON
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      
      }
      //funcion q obtiene datos x id
      public function get_user($usuario)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          $sql = "SELECT * FROM usuarios WHERE usuario = ?";
          $sql = $conectar->prepare($sql);
          $sql->bindParam(1, $usuario);
          $sql->execute();
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      }
     //funcion q inserta nuevo item 
        public function insert_user($usuario,$password)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          $sql = "INSERT INTO usuarios (usuario, password) VALUES (?, ?);";
          $sql = $conectar->prepare($sql);
          //insertar datos
          $sql->bindParam(1, $usuario);
          $sql->bindParam(2, $password);

          $sql->execute();
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      }
      //funcion q obtiene datos x id
      public function update_clave($usuario,$password)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          $sql = "UPDATE usuarios SET password = ? WHERE usuario= ?";
          $sql = $conectar->prepare($sql);
          //insertar las categorias 
          $sql->bindParam(1, $password);
          $sql->bindParam(2, $usuario);
          $sql->execute();
         
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      }

         //funcion modifica clave con pregunta de verif
         public function update_clave_pv($usuario,$password)
         {
             //CONECTA LA BD
             $conectar = parent::conexion();
             parent::set_name();
             $sql = "UPDATE usuarios SET password = ? WHERE usuario= ? ";
             $sql = $conectar->prepare($sql);
             //insertar las categorias 
             $sql->bindParam(1, $password);
             $sql->bindParam(2, $usuario);
             $sql->execute();
            
             return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
         }
 
      //borra todo el item
      public function delete_user($usuario)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          //funcion a realizar
          $sql = "DELETE FROM usuarios WHERE usuario = ?";
          $sql = $conectar->prepare($sql);
          //insertar las categorias 
          $sql->bindParam(1, $usuario);
          $sql->execute();
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      } 

      public function verificar($usuario,$password)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          $sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
          $sql = $conectar->prepare($sql);
          $sql->bindParam(1, $usuario);
          $sql->bindParam(2, $password);
          $sql->execute();
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      }

      public function verificar_pv($usuario,$PVmascota)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          $sql = "SELECT * FROM usuarios WHERE usuario = ? AND PVmascota = ?";
          $sql = $conectar->prepare($sql);
          $sql->bindParam(1, $usuario);
          $sql->bindParam(2, $PVmascota);
          $sql->execute();
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      }


//factuiracion   


public function insert_factura($cedula,$cliente,$total)
      {
          //CONECTA LA BD
          $conectar = parent::conexion();
          parent::set_name();
          $sql = "INSERT INTO facturas (cedula, cliente,total) VALUES (?, ?, ? );";
          $sql = $conectar->prepare($sql);
          //insertar datos
          $sql->bindParam(1, $cedula);
          $sql->bindParam(2, $cliente);
          $sql->bindParam(3, $total);

          $sql->execute();
          return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      }

//buscar libro



      
}



