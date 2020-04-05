<?php

include_once 'Conexion.php';
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
        $this->desconectar();

        return $ok;
    }

    function listar()
    {
        $arreglo = array();
        $this->conectar();

        $sql="SELECT * from usuario";
        $resultados = $this->miConexion->query($sql);
        while($fila = $resultado->fetch_assoc())
        {
            $vehiculo = new Vehiculo();
            $vehiculo->id = $fila['id'];
            $vehiculo->patente = $fila['patente'];
            $vehiculo->largo = $fila['largo'];
            $vehiculo->ancho = $fila['ancho'];
            $vehiculo->peso = $fila['peso'];
            $vehiculo->tipoVehiculo_id = $fila['tipoVehiculo_id'];
            $vehiculo->modelo_id = $fila['modelo_id'];
            $vehiculo->usuario_id = $fila['usuario_id']; 
            
            $arreglo[] = $vehiculo;
        } 

        $this->desconectar();

        return $arreglo;
    }

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
            $vehiculo->id = $fila['id'];
            $vehiculo->patente = $fila['patente'];
            $vehiculo->largo = $fila['largo'];
            $vehiculo->ancho = $fila['ancho'];
            $vehiculo->peso = $fila['peso'];
            $vehiculo->tipoVehiculo_id = $fila['tipoVehiculo_id'];
            $vehiculo->modelo_id = $fila['modelo_id'];
            $vehiculo->usuario_id = $fila['usuario_id']; 
            
            $arreglo[] = $vehiculo;

        }
        $this->desconectar();

        return $devolver;
    }

    function Editar($vehiculo)
    {
        $this->conectar();
        $sql="UPDATE usuario set 
        patente=?, largo=?, ancho=?, peso=?, tipoVehiculo_id=?, modelo_id=?, usuario_id=?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("siiiiii", $vehiculo->patente, $vehiculo->largo, $vehiculo->ancho, $vehiculo->peso, $vehiculo->precio, $vehiculo->tipoVehiculo_id, $vehiculo->modelo_id, $vehiculo->usuario_id);
        $ok=$stmt->execute();
        $this->desconectar();
        

        return $ok;
    }

    function Eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from vehiculo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    

}