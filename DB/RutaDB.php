<?php

include_once 'Conexion.php';
include_once 'Ruta.php';

class RutaDB extends Conexion
{
<<<<<<< HEAD

    function crear($ruta)
    {

        $this->conectar();

        $sql = "INSERT INTO ruta (id, direccionInicio, direccionFinal, distancia, fechaInicio, fechaFin)
                VALUES (?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql);

        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("isssss", $ruta->id, $ruta->direccionInicio, $ruta->direccionFinal, $ruta->distancia, $ruta->fechaInicio, $ruta->fechaFin);
        $ok = $stmt->execute();
=======
    function crear($ruta)
    {
        $this->conectar();

        $sql = "INSERT INTO ruta (id, direccionInicio, direccionFinal, distancia, fechaInicio, fechaFin) 
                VALUES(?,?,?,?,?,?)";
        
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("issddss", $ruta->id, $ruta->direccionInicio, $ruta->direccionFinal, $ruta->distancia, $ruta->fechaInicio, $ruta->fechaFinal);
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

        $sql = "SELECT * from estado";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $estado = new Estado();
            $estado->id = $fila['id'];
            $estado->nombre = $fila['nombre'];


            $arreglo[] = $estado;
        }
=======
        $arreglo = array();
        $this->conectar();

        $sql="SELECT * from ruta";
        $resultados = $this->miConexion->query($sql);
        while($fila = $resultado->fetch_assoc())
        {
            $ruta = new Ruta();
            $ruta->id = $fila['id'];
            $ruta->direccionInicio = $fila['direccionInicio'];
            $ruta->direcionFinal = $fila['direccionFinal'];
            $ruta->distancia = $fila['distancia'];
            $ruta->fechaInicio = $fila['fechaInicio'];
            $ruta->fechaFin = $fila['fechaFin'];

            $arreglo[] = $ruta;
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

=======
    function Buscar($id)
    {
        $devolver = null;
        $this->conectar();

        $sql = "SELECT * FROM ruta where id = ?";
        $stmt = $this->miConexion->prepare(sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while($fila=$resultados->fetch_assoc())
        {
            $ruta = new Ruta();
            $ruta->id = $fila['id'];
            $ruta->direccionInicio = $fila['direccionInicio'];
            $ruta->direcionFinal = $fila['direccionFinal'];
            $ruta->distancia = $fila['distancia'];
            $ruta->fechaInicio = $fila['fechaInicio'];
            $ruta->fechaFin = $fila['fechaFin'];
            $devolver = $ruta;

        }
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
        $this->desconectar();

        return $devolver;
    }

<<<<<<< HEAD
    function editar($estado)
    {
        $this->conectar();
        $sql = "UPDATE estado set
                nombre = ? where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("si", $estado->nombre, $estado->id);
        $ok = $stmt->execute();
        $this->desconectar();
=======
    function Editar($ruta)
    {
        $this->conectar();
        $sql="UPDATE ruta set 
        direccionInicio=?, direccionFinal=?, fechaInicio=?, fechaFin=?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("ssss", $ruta->direccionInicio, $ruta->direccionFinal, $ruta->fechaInicio, $ruta->fechaFin);
        $ok=$stmt->execute();
        $this->desconectar();
        
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0

        return $ok;
    }

<<<<<<< HEAD

    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from estado where id = ?";
=======
    function Eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from ruta where id = ?";
>>>>>>> b7cbbeaf7a72c3a2427eaf8cfb997d7688fe03a0
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
