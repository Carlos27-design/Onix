<?php

include_once 'Conexion.php';
include_once 'Usuario.php';

class UsuarioDB extends Conexion
{
    function crear($usuario)
    {
        $this->conectar();

        $sql = "INSERT INTO usuario (id, rut, nombre, apellido, contrasena, correo, nroTelefonico, tipoUsuario_id) 
                VALUES(?,?,?,?,?,?,?,?)";
        
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("issssssi", $usuario->id, $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico, $usuario->tipoUsuario_id);
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
            $usuario = new Usuario();
            $usuario->id = $fila['id'];
            $usuario->rut = $fila['rut'];
            $usuario->nombre = $fila['nombre'];
            $usuario->apellido = $fila['apellido'];
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];
            
            $arreglo[] = $usuario;
        } 

        $this->desconectar();

        return $arreglo;
    }

    function Buscar($id)
    {
        $devolver = null;
        $this->conectar();

        $sql = "SELECT * FROM usuario where id = ?";
        $stmt = $this->miConexion->prepare(sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while($fila=$resultados->fetch_assoc())
        {
            $usuario = new Usuario();
            $usuario->id = $fila['id'];
            $usuario->rut = $fila['rut'];
            $usuario->nombre = $fila['nombre'];
            $usuario->apellido = $fila['apellido'];
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];
            
            $arreglo[] = $usuario;

        }
        $this->desconectar();

        return $devolver;
    }

    function Editar($ruta)
    {
        $this->conectar();
        $sql="UPDATE usuario set 
        rut=?, nombre=?, apellido=?, contrasena=?, correo=?, nroTelefonico=?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("ssssss", $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico );
        $ok=$stmt->execute();
        $this->desconectar();
        

        return $ok;
    }

    function Eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from usuario where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    

}