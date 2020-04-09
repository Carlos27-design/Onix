<?php

include_once 'Conexion.php';
include_once 'TipoVehiculo.php';

class TipoVehiculoDB extends Conexion
{

    function crear($tipoVehiculo)
    {

        $this->conectar();

        $sql = "INSERT INTO tipoVehiculo (id, nombre)
                VALUES (?,?)";

        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("is", $tipoVehiculo->id, $tipoVehiculo->nombre);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from tipoVehiculo";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $tipoVehiculo = new TipoVehiculo();
            $tipoVehiculo->id = $fila['id'];
            $tipoVehiculo->nombre = $fila['nombre'];


            $arreglo[] = $tipoVehiculo;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from tipoVehiculo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $tipoVehiculo = new TipoVehiculo();
            $tipoVehiculo->id = $fila['id'];
            $tipoVehiculo->nombre = $fila['nombre'];

            $devolver = $tipoVehiculo;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($tipoVehiculo)
    {
        $this->conectar();
        $sql = "UPDATE tipoVehiculo set
                nombre = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("si", $tipoVehiculo->nombre, $tipoVehiculo->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from tipoVehiculo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
}
