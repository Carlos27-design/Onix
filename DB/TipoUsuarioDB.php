<?php

include_once 'Conexion.php';
include_once 'TipoUsuario.php';

class TipoUsuarioDB extends Conexion
{

    function crear($tipoUsuario)
    {

        $this->conectar();

        $sql = "INSERT INTO tipoUsuario (id, nombre)
                VALUES (?,?)";

        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("is", $tipoUsuario->id, $tipoUsuario->nombre);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from tipoUsuario";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $tipoUsuario = new TipoUsuario();
            $tipoUsuario->id = $fila['id'];
            $tipoUsuario->nombre = $fila['nombre'];


            $arreglo[] = $tipoUsuario;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from tipoUsuario where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $tipoUsuario = new TipoUsuario();
            $tipoUsuario->id = $fila['id'];
            $tipoUsuario->nombre = $fila['nombre'];

            $devolver = $tipoUsuario;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($tipoUsuario)
    {
        $this->conectar();
        $sql = "UPDATE tipousuario set
                nombre = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("si", $tipoUsuario->nombre, $tipoUsuario->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from tipoUsuario where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
}
