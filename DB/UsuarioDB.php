<?php

include_once 'Conexion.php';
include_once 'Usuario.php';

class UsuarioDB extends Conexion
{

    function crear($usuario)
    {

        $this->conectar();

        $sql = "INSERT INTO usuario (id, rut, nombre, apellido, contrasena, correo, nroTelefonico,tipoUsuario_id)
                VALUES (?,?,?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("issssssi", $usuario->id, $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico, $usuario->tipoUsuario_id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from usuario";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $usuario = new Usuario();
            $usuario->id = $fila['id'];
            $usuario->rut = $fila['rut'];
            $usuario->nombre = $fila['nombre'];
            $usuario->apellido = $fila['apellido'];
            $usuario->contrasena = $fila['contrasena'];
            $usuario->correo = $fila['correo'];
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];

            $arreglo[] = $usuario;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from usuario where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $usuario = new Usuario();
            $usuario->id = $fila['id'];
            $usuario->rut = $fila['rut'];
            $usuario->nombre = $fila['nombre'];
            $usuario->apellido = $fila['apellido'];
            $usuario->contrasena = $fila['contrasena'];
            $usuario->correo = $fila['correo'];
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];

            $devolver = $usuario;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($usuario)
    {
        $this->conectar();
        $sql = "UPDATE usuario set
                rut = ?, nombre = ?, apellido = ?, contrasena = ?, correo = ?, nroTelefonico = ?, tipoUsuario_id = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("ssssssii", $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico, $usuario->tipoUsuario_id, $usuario->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from usuario where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
    function login($rut, $password)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from usuario where rut = ? AND contrasena = ?";
        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("ss", $rut, $password);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $usuario = new Usuario();
            $usuario->rut = $fila['rut'];
            $usuario->contrasena = $fila['contrasena'];

            $devolver = $usuario;
        }

        $this->desconectar();

        return $devolver;
    }
}
