<?php

include_once 'Conexion.php';
include_once 'Modelo.php';

class ModeloDB extends Conexion
{

    function crear($modelo)
    {

        $this->conectar();

        $sql = "INSERT INTO modelo (id, nombre, marca_id)
                VALUES (?,?,?)";

        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("isi", $modelo->id, $modelo->nombre, $modelo->marca_id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from modelo";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $modelo = new Modelo();
            $modelo->id = $fila['id'];
            $modelo->nombre = $fila['nombre'];
            $modelo->marca_id = $fila['marca_id'];


            $arreglo[] = $modelo;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from modelo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $modelo = new Modelo();
            $modelo->id = $fila['id'];
            $modelo->nombre = $fila['nombre'];
            $modelo->marca_id = $fila['marca_id'];

            $devolver = $modelo;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($modelo)
    {
        $this->conectar();
        $sql = "UPDATE modelo set
                nombre = ?,marca_id = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("sii", $modelo->nombre, $modelo->marca_id, $modelo->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from modelo where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
}
