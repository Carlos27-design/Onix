<?php

include_once 'Conexion.php';
<<<<<<< HEAD
include_once 'Vehiculo.php';

class VehiculoDB extends Conexion
{

    function crear($vehiculo)
    {

        $this->conectar();

        $sql = "INSERT INTO vehiculo (id, patente, largo, ancho, peso, precio, tipoVehiculo_id,modelo_id,usuario_id)
                VALUES (?,?,?,?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("isiiiiiii", $vehiculo->id, $vehiculo->patente, $vehiculo->largo, $vehiculo->ancho, $vehiculo->peso, $vehiculo->precio, $vehiculo->tipoVehiculo_id, $vehiculo->modelo_id, $vehiculo->usuario_id);
        $ok = $stmt->execute();
=======
include_once 'Usuario.php';

class VehiculoDB extends Conexion
{
    function crear($vehiculo)
    {
        $this->conectar();

        $sql = "INSERT INTO vehiculo (id, patente, largo, ancho, peso, precio, tipoVehiculo_id, modelo_id, usuario_id) 
                VALUES(?,?,?,?,?,?,?,?,?)";
        
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("isiiiiiii", $vehiculo->id, $vehiculo->patente, $vehiculo->largo, $vehiculo->ancho, $vehiculo->peso, $vehiculo->precio, $vehiculo->tipoVehiculo_id, $vehiculo->modelo_id, $vehiculo->usuario_id);
        $ok=$stmt->execute();
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
        $this->desconectar();

        return $ok;
    }

    function listar()
    {
<<<<<<< HEAD

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from vehiculo";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
=======
        $arreglo = array();
        $this->conectar();

        $sql="SELECT * from usuario";
        $resultados = $this->miConexion->query($sql);
        while($fila = $resultado->fetch_assoc())
        {
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
            $vehiculo = new Vehiculo();
            $vehiculo->id = $fila['id'];
            $vehiculo->patente = $fila['patente'];
            $vehiculo->largo = $fila['largo'];
            $vehiculo->ancho = $fila['ancho'];
            $vehiculo->peso = $fila['peso'];
<<<<<<< HEAD
            $vehiculo->precio = $fila['precio'];
            $vehiculo->tipoVehiculo_id = $fila['tipoVehiculo_id'];
            $vehiculo->modelo_id = $fila['modelo_id'];
            $vehiculo->usuario_id = $fila['usuario_id'];

            $arreglo[] = $vehiculo;
        }
=======
            $vehiculo->tipoVehiculo_id = $fila['tipoVehiculo_id'];
            $vehiculo->modelo_id = $fila['modelo_id'];
            $vehiculo->usuario_id = $fila['usuario_id']; 
            
            $arreglo[] = $vehiculo;
        } 
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0

        $this->desconectar();

        return $arreglo;
    }

<<<<<<< HEAD
    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from vehiculo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $vehiculo = new Vehiculo();
=======
    function Buscar($id)
    {
        $devolver = null;
        $this->conectar();

        $sql = "SELECT * FROM vehiculo where id = ?";
        $stmt = $this->miConexion->prepare(sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while($fila=$resultados->fetch_assoc())
        {
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
            $vehiculo->id = $fila['id'];
            $vehiculo->patente = $fila['patente'];
            $vehiculo->largo = $fila['largo'];
            $vehiculo->ancho = $fila['ancho'];
            $vehiculo->peso = $fila['peso'];
<<<<<<< HEAD
            $vehiculo->precio = $fila['precio'];
            $vehiculo->tipoVehiculo_id = $fila['tipoVehiculo_id'];
            $vehiculo->modelo_id = $fila['modelo_id'];
            $vehiculo->usuario_id = $fila['usuario_id'];


            $devolver = $vehiculo;
        }

=======
            $vehiculo->tipoVehiculo_id = $fila['tipoVehiculo_id'];
            $vehiculo->modelo_id = $fila['modelo_id'];
            $vehiculo->usuario_id = $fila['usuario_id']; 
            
            $arreglo[] = $vehiculo;

        }
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
        $this->desconectar();

        return $devolver;
    }

<<<<<<< HEAD
    function editar($vehiculo)
    {
        $this->conectar();
        $sql = "UPDATE vehiculo set
                patente = ?, largo = ?, ancho = ?, peso = ?, precio = ?, tipoVehiculo_id = ?, modelo_id = ?, usuario_id = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("siiiiiiii", $vehiculo->patente, $vehiculo->largo, $vehiculo->ancho, $vehiculo->peso, $vehiculo->precio, $vehiculo->tipoVehiculo_id, $vehiculo->modelo_id, $vehiculo->usuario_id, $vehiculo->id);
        $ok = $stmt->execute();
        $this->desconectar();
=======
    function Editar($vehiculo)
    {
        $this->conectar();
        $sql="UPDATE usuario set 
        patente=?, largo=?, ancho=?, peso=?, tipoVehiculo_id=?, modelo_id=?, usuario_id=?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("siiiiii", $vehiculo->patente, $vehiculo->largo, $vehiculo->ancho, $vehiculo->peso, $vehiculo->precio, $vehiculo->tipoVehiculo_id, $vehiculo->modelo_id, $vehiculo->usuario_id);
        $ok=$stmt->execute();
        $this->desconectar();
        
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0

        return $ok;
    }

<<<<<<< HEAD

    function eliminar($id)
=======
    function Eliminar($id)
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
    {
        $this->conectar();
        $sql = "DELETE from vehiculo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
<<<<<<< HEAD
        return $ok;
    }
}
=======

        return $ok;
    }

    

}
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
