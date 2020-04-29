<?php

include_once 'Conexion.php';
include_once 'Entrega.php';

class EntregaDB extends Conexion
{

    function crear($entrega)
    {

        $this->conectar();

        $sql = "INSERT INTO entrega (id, usuario_id, vehiculo_id, ruta_id, estado_id, direccionEntrega, nroDocumentoEntregado, fechaInicio, fechaEntregado, indicaciones)
                VALUES (?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("iiiiisssss", $entrega->id, $entrega->usuario_id, $entrega->vehiculo_id, $entrega->ruta_id, $entrega->estado_id, $entrega->direccionEntrega, $entrega->nroDocumentoEntregado, $entrega->fechaInicio, $entrega->fechaEntregado, $entrega->indicaciones);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }

    function listar()
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from entrega";
        $resultados = $this->miConexion->query($sql);
        while ($fila = $resultados->fetch_assoc()) {
            $entrega = new Entrega();
            $entrega->id = $fila['id'];
            $entrega->usuario_id = $fila['usuario_id'];
            $entrega->vehiculo_id = $fila['vehiculo_id'];
            $entrega->ruta_id = $fila['ruta_id'];
            $entrega->estado_id = $fila['estado_id'];
            $entrega->direccionEntrega = $fila['direccionEntrega'];
            $entrega->nroDocumentoEntregado = $fila['nroDocumentoEntregado'];
            $entrega->fechaInicio = $fila['fechaInicio'];
            $entrega->fechaEntregado = $fila['fechaEntregado'];
            $entrega->indicaciones = $fila['indicaciones'];

            $arreglo[] = $entrega;
        }

        $this->desconectar();

        return $arreglo;
    }

    function buscar($id)
    {

        $devolver = null;
        $this->conectar();

        $sql = "SELECT * from entrega where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $entrega = new Entrega();
            $entrega->id = $fila['id'];
            $entrega->usuario_id = $fila['usuario_id'];
            $entrega->vehiculo_id = $fila['vehiculo_id'];
            $entrega->ruta_id = $fila['ruta_id'];
            $entrega->estado_id = $fila['estado_id'];
            $entrega->direccionEntrega = $fila['direccionEntrega'];
            $entrega->nroDocumentoEntregado = $fila['nroDocumentoEntregado'];
            $entrega->fechaInicio = $fila['fechaInicio'];
            $entrega->fechaEntregado = $fila['fechaEntregado'];
            $entrega->indicaciones = $fila['indicaciones'];

            $devolver = $entrega;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($entrega)
    {
        $this->conectar();
        $sql = "UPDATE entrega set
                usuario_id = ?, vehiculo_id = ?, ruta_id = ?, estado_id = ?, direccionEntrega = ?, nroDocumentoEntregado = ?, fechaInicio = ?, fechaEntregado = ?, indicaciones = ?  where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("iiiisssssi", $entrega->usuario_id, $entrega->vehiculo_id, $entrega->ruta_id, $entrega->estado_id, $entrega->direccionEntrega, $entrega->nroDocumentoEntregado,  $entrega->fechaInicio, $entrega->fechaEntregado, $entrega->indicaciones, $entrega->id);
        $ok = $stmt->execute();
        $this->desconectar();

        return $ok;
    }


    function eliminar($id)
    {
        $this->conectar();
        $sql = "DELETE from entrega where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $this->desconectar();
        return $ok;
    }
}
