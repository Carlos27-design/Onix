<?php

include_once 'Conexion.php';
include_once 'Comprobante.php';

class ComprobanteDB extends Conexion
{
    function crear($comprobante)
    {
        $this->conectar();

        $sql = "INSERT INTO comprobante (id, folio, fecha, total, entrega_id) 
                VALUES(?,?,?,?,?)";
        
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("iisii", $comprobante->id, $comprobante->folio, $comprobante->fecha, $comprobante->total, $comprobante->entrega_id);
        $ok=$stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {
        $arreglo = array();
        $this->conectar();

        $sql="SELECT * from comprobante";
        $resultados = $this->miConexion->query($sql);
        while($fila = $resultado->fetch_assoc())
        {
            $comprobante = new Comprobante();
            $comprobante->id = $fila['id'];
            $comprobante->folio = $fila['folio'];
            $comprobante->fecha = $fila['fecha'];
            $comprobante->total = $fila['total'];
            $comprobante->entrega_id = $fila['entrega_id'];

            $arreglo[] = $comprobante;
        } 

        $this->desconectar();

        return $arreglo;
    }

    function Buscar($id)
    {
        $devolver = null;
        $this->conectar();

        $sql = "SELECT * FROM comprobante where id = ?";
        $stmt = $this->miConexion->prepare(sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while($fila=$resultados->fetch_assoc())
        {
            $comprobante = new Comprobante();
            $comprobante->id = $fila['id'];
            $comprobante->folio = $fila['folio'];
            $comprobante->fecha = $fila['fecha'];
            $comprobante->total = $fila['total'];
            $comprobante->entrega_id = $fila['entrega_id'];

            $devolver = $comprobante;

        }
        $this->desconectar();

        return $devolver;
    }

    function Editar($comprobante)
    {
        $this->conectar();
        $sql="UPDATE comprobante set 
        fecha=?, total=?, entrega_id=?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("sii", $comprobante->fecha, $comprobante->total, $comprobante->entrega_id);
        $ok=$stmt->execute();
        $this->desconectar();
        

        return $ok;
    }

    function Eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from comprobante where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    

}