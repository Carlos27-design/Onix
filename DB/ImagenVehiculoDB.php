<?php

include_once 'Conexion.php';
include_once 'ImagenVehiculo.php';

class ImagenVehiculoDB extends Conexion
{

    function crear($imagenVehiculo)
    {

        $this->conectar();

        $sql = "INSERT INTO imagenvehiculo (id, ruta, vehiculo_id)
                VALUES (?,?,?)";

        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("isi", $imagenVehiculo->id, $imagenVehiculo->ruta, $imagenVehiculo->vehiculo_id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from imagenvehiculo";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $imagenVehiculo = new imagenVehiculo();
            $imagenVehiculo->id = $fila['id'];
            $imagenVehiculo->ruta = $fila['ruta'];
            $imagenVehiculo->vehiculo_id = $fila['vehiculo_id'];


            $arreglo[] = $imagenVehiculo;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from imagenvehiculo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $imagenVehiculo = new imagenVehiculo();
            $imagenVehiculo->id = $fila['id'];
            $imagenVehiculo->ruta = $fila['ruta'];
            $imagenVehiculo->vehiculo_id = $fila['vehiculo_id'];

            $devolver = $imagenVehiculo;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($imagenVehiculo)
    {
        $this->conectar();
        $sql = "UPDATE imagenvehiculo set
                ruta = ?, vehiculo_id = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("sii", $imagenVehiculo->ruta, $imagenVehiculo->vehiculo_id, $imagenVehiculo->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from imagenvehiculo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
}
