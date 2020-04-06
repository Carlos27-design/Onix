<?php

include_once 'Conexion.php';
include_once 'Ruta.php';

class RutaDB extends Conexion
{

    function crear($ruta)
    {

        $this->conectar();

        $sql = "INSERT INTO ruta (id, direccionInicio, direccionFinal, distancia, fechaInicio, fechaFin)
                VALUES (?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql);

        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("isssss", $ruta->id, $ruta->direccionInicio, $ruta->direccionFinal, $ruta->distancia, $ruta->fechaInicio, $ruta->fechaFin);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from estado";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $estado = new Estado();
            $estado->id = $fila['id'];
            $estado->nombre = $fila['nombre'];


            $arreglo[] = $estado;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from estado where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $estado = new Estado();
            $estado->id = $fila['id'];
            $estado->nombre = $fila['nombre'];

            $devolver = $estado;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($estado)
    {
        $this->conectar();
        $sql = "UPDATE estado set
                nombre = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("si", $estado->nombre, $estado->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from estado where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
}
