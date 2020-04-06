<?php

include_once 'Conexion.php';
include_once 'Usuario.php';

class UsuarioDB extends Conexion
{
<<<<<<< HEAD

    function crear($usuario)
    {

        $this->conectar();

        $sql = "INSERT INTO usuario (id, rut, nombre, apellido, contrasena, correo, nroTelefonico,tipoUsuario_id)
                VALUES (?,?,?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("issssssi", $usuario->id, $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico, $usuario->tipoUsuario_id);
        $ok = $stmt->execute();
=======
    function crear($usuario)
    {
        $this->conectar();

        $sql = "INSERT INTO usuario (id, rut, nombre, apellido, contrasena, correo, nroTelefonico, tipoUsuario_id) 
                VALUES(?,?,?,?,?,?,?,?)";
        
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("issssssi", $usuario->id, $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico, $usuario->tipoUsuario_id);
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

        $sql = "SELECT * from usuario";
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
            $usuario = new Usuario();
            $usuario->id = $fila['id'];
            $usuario->rut = $fila['rut'];
            $usuario->nombre = $fila['nombre'];
            $usuario->apellido = $fila['apellido'];
<<<<<<< HEAD
            $usuario->contrasena = $fila['contrasena'];
            $usuario->correo = $fila['correo'];
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];

            $arreglo[] = $usuario;
        }
=======
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];
            
            $arreglo[] = $usuario;
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

        $sql = "SELECT * from usuario where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
=======
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
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
            $usuario = new Usuario();
            $usuario->id = $fila['id'];
            $usuario->rut = $fila['rut'];
            $usuario->nombre = $fila['nombre'];
            $usuario->apellido = $fila['apellido'];
<<<<<<< HEAD
            $usuario->contrasena = $fila['contrasena'];
            $usuario->correo = $fila['correo'];
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];

            $devolver = $usuario;
        }

=======
            $usuario->nroTelefonico = $fila['nroTelefonico'];
            $usuario->tipoUsuario_id = $fila['tipoUsuario_id'];
            
            $arreglo[] = $usuario;

        }
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
        $this->desconectar();

        return $devolver;
    }

<<<<<<< HEAD
    function editar($usuario)
    {
        $this->conectar();
        $sql = "UPDATE usuario set
                rut = ?, nombre = ?, apellido = ?, contrasena = ?, correo = ?, nroTelefonico = ?, tipoUsuario_id = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("ssssssii", $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico, $usuario->tipoUsuario_id, $usuario->id);
        $ok = $stmt->execute();
        $this->desconectar();
=======
    function Editar($ruta)
    {
        $this->conectar();
        $sql="UPDATE usuario set 
        rut=?, nombre=?, apellido=?, contrasena=?, correo=?, nroTelefonico=?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("ssssss", $usuario->rut, $usuario->nombre, $usuario->apellido, $usuario->contrasena, $usuario->correo, $usuario->nroTelefonico );
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
        $sql = "DELETE from usuario where id = ?";
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
