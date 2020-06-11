<?php

include_once 'Conexion.php';
include_once 'Ruta.php';

class RutaDB extends Conexion
{
    function crear($ruta)
    {
        $this->conectar();

        $sql = "INSERT INTO ruta (id, direccionInicio, direccionFinal, distancia, fechaInicio, fechaFin, direccionInicioNombre, direccionFinalNombre) 
                VALUES(?,?,?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("isssssss", $ruta->id, $ruta->direccionInicio, $ruta->direccionFinal, $ruta->distancia, $ruta->fechaInicio, $ruta->fechaFin, $ruta->direccionInicioNombre, $ruta->direccionFinalNombre);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {
        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from ruta";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $ruta = new Ruta();
            $ruta->id = $fila['id'];
            $ruta->direccionInicio = $fila['direccionInicio'];
            $ruta->direccionFinal = $fila['direccionFinal'];
            $ruta->distancia = $fila['distancia'];
            $ruta->fechaInicio = $fila['fechaInicio'];
            $ruta->fechaFin = $fila['fechaFin'];
            $ruta->direccionInicioNombre = $fila['direccionInicioNombre'];
            $ruta->direccionFinalNombre = $fila['direccionFinalNombre'];

            $arreglo[] = $ruta;
        }

        $this->desconectar();

        return $arreglo;
    }
    function reporte($fechaInicio, $fechaFin)
    {

        $devolver = array();
        $this->conectar();

        $sql = "select * from ruta where fechaInicio > ? AND fechaInicio < ?";
        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("ss", $fechaInicio, $fechaFin);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $ruta = new Ruta();
            $ruta->id = $fila['id'];
            $ruta->direccionInicio = $fila['direccionInicio'];
            $ruta->direccionFinal = $fila['direccionFinal'];
            $ruta->distancia = $fila['distancia'];
            $ruta->fechaInicio = $fila['fechaInicio'];
            $ruta->fechaFin = $fila['fechaFin'];
            $ruta->direccionInicioNombre = $fila['direccionInicioNombre'];
            $ruta->direccionFinalNombre = $fila['direccionFinalNombre'];


            $devolver[] = $ruta;
        }

        $this->desconectar();

        return $devolver;
    }

    function Buscar($id)
    {
        $devolver = null;
        $this->conectar();

        $sql = "SELECT * FROM ruta where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $ruta = new Ruta();
            $ruta->id = $fila['id'];
            $ruta->direccionInicio = $fila['direccionInicio'];
            $ruta->direccionFinal = $fila['direccionFinal'];
            $ruta->distancia = $fila['distancia'];
            $ruta->fechaInicio = $fila['fechaInicio'];
            $ruta->fechaFin = $fila['fechaFin'];
            $ruta->direccionInicioNombre = $fila['direccionInicioNombre'];
            $ruta->direccionFinalNombre = $fila['direccionFinalNombre'];

            $devolver = $ruta;
        }
        $this->desconectar();

        return $devolver;
    }

    function Editar($ruta)
    {
        $this->conectar();
        $sql = "UPDATE ruta set 
        direccionInicio=?, direccionFinal=?, distancia=?, fechaInicio=?, fechaFin=?, direccionInicioNombre = ?, direccionFinalNombre = ? where id=?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("sssssi", $ruta->direccionInicio, $ruta->direccionFinal, $ruta->distancia, $ruta->fechaInicio, $ruta->fechaFin, $ruta->direccionInicioNombre, $ruta->direccionFinalNombre, $ruta->id);
        $ok = $stmt->execute();
        $this->desconectar();


        return $ok;
    }

    function Eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from ruta where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }
}
