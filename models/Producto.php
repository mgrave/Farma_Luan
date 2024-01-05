<?php
require_once 'Conexion.php';

class Productos extends Conexion{
    private $connection;

    public function __CONSTRUCT(){
        $this->connection = parent::getConnect();
    }

    
public function productos_listar(){
    try{
        $query = $this->connection->prepare("CALL spu_productos_listar()");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }catch(Exception $err){
        die($err->getMessage());
    }
}

public function get_categorias(){
    try{
        $query = $this->connection->prepare("SELECT * FROM categorias");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }catch(Exception $err){
        die($err->getMessage());
    }
}


public function productos_registrar ($datos = []){
    $respuesta = [
        "status" => false,
        "message" => ""
    ];
    try{
        $consulta = $this->connection->prepare("CALL spu_productos_registrar(?,?,?,?,?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["idcategoria"],
            $datos["nombreproducto"],
            $datos["descripcion"],
            $datos["precio"],            
            $datos["fechaproduccion"],
            $datos["fechavencimiento"],
            $datos["numlote"],
            $datos["recetamedica"]
        ));
    }
    catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
    }
    return $respuesta;
}

public function productos_actualizar ($datos = []){
    $respuesta = [
        "status" => false,
        "message" => ""
    ];
    try{
        $consulta = $this->connection->prepare("CALL spu_productos_update(?,?,?,?,?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["idproducto"],
            $datos["idcategoria"],
            $datos["nombreproducto"],
            $datos["descripcion"],
            $datos["precio"],            
            $datos["fechaproduccion"],
            $datos["fechavencimiento"],
            $datos["numlote"],
            $datos["recetamedica"]
        ));
    }
    catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
    }
    return $respuesta;
}

public function get_productos($idproducto = 0){
    $respuesta = [
      "status"    => false,
      "message"   => ""
    ];
    try{
      $query = $this->connection->prepare("CALL spu_getProductos(?)");
      $respuesta["status"] = $query->execute(array($idproducto));
      return $query->fetch(PDO::FETCH_ASSOC);
      
    }catch(Exception $e){
      $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
    }
  }





}

?>