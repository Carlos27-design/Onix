<?php

include_once 'Conexion.php';
include_once 'Marca.php';

class MarcaDB extends Conexion
{

    function crear($marca)
    {

        $this->conectar();

        $sql = "INSERT INTO marca (id, nombre)
                VALUES (?,?)";

        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("is", $marca->id, $marca->nombre);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from marca";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $marca = new Marca();
            $marca->id = $fila['id'];
            $marca->nombre = $fila['nombre'];


            $arreglo[] = $marca;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from marca where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $marca = new Marca();
            $marca->id = $fila['id'];
            $marca->nombre = $fila['nombre'];

            $devolver = $marca;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($marca)
    {
        $this->conectar();
        $sql = "UPDATE marca set
                nombre = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("si", $marca->nombre, $marca->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from marca where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
}
