<?php

include_once 'Conexion.php';
include_once 'Entrega.php';

class EntregaDB extends Conexion
{

    function crear($entrega)
    {

        $this->conectar();

        $sql = "INSERT INTO entrega (id, usuario_id, vehiculo_id, ruta_id, estado_id, direccionEntrega, nroDocumentoEntregado, fechaInicio, fechaEntregado, indicaciones, direccionEntregaNombre)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("iiiiissssss", $entrega->id, $entrega->usuario_id, $entrega->vehiculo_id, $entrega->ruta_id, $entrega->estado_id, $entrega->direccionEntrega, $entrega->nroDocumentoEntregado, $entrega->fechaInicio, $entrega->fechaEntregado, $entrega->indicaciones, $entrega->direccionEntregaNombre);
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
            $entrega->direccionEntregaNombre = $fila['direccionEntregaNombre'];

            $arreglo[] = $entrega;
        }

        $this->desconectar();

        return $arreglo;
    }
    function listarMisEntregas($id)
    {

        $arreglo = array();
        $this->conectar();

        $sql = "SELECT * from entrega where usuario_id=" . $id;
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
            $entrega->direccionEntregaNombre = $fila['direccionEntregaNombre'];

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
            $entrega->direccionEntregaNombre = $fila['direccionEntregaNombre'];

            $devolver = $entrega;
        }

        $this->desconectar();

        return $devolver;
    }
    function reportePorVehiculo($id, $fechaInicio, $fechaFin)
    {

        $devolver = array();
        $this->conectar();

        $sql = "select * from entrega where vehiculo_id=? AND fechaInicio > ? AND fechaInicio < ?";
        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("iss", $id, $fechaInicio, $fechaFin);
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
            $entrega->direccionEntregaNombre = $fila['direccionEntregaNombre'];

            $devolver[] = $entrega;
        }

        $this->desconectar();

        return $devolver;
    }
    function reporteTodosVehiculos($fechaInicio, $fechaFin)
    {

        $devolver = array();
        $this->conectar();

        $sql = "select * from entrega where fechaInicio > ? AND fechaInicio < ?";
        $stmt = $this->miConexion->prepare($sql) or trigger_error($this->miConexion->error . "[$sql]");
        $stmt->bind_param("ss", $fechaInicio, $fechaFin);
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
            $entrega->direccionEntregaNombre = $fila['direccionEntregaNombre'];

            $devolver[] = $entrega;
        }

        $this->desconectar();

        return $devolver;
    }

    function editar($entrega)
    {
        $this->conectar();
        $sql = "UPDATE entrega set
                usuario_id = ?, vehiculo_id = ?, ruta_id = ?, estado_id = ?, direccionEntrega = ?, nroDocumentoEntregado = ?, fechaInicio = ?, fechaEntregado = ?, indicaciones = ?, direccionEntregaNombre = ?  where id = ?";
        $stmt = $this->miConexion->prepare($sql);
        $stmt->bind_param("iiiissssssi", $entrega->usuario_id, $entrega->vehiculo_id, $entrega->ruta_id, $entrega->estado_id, $entrega->direccionEntrega, $entrega->nroDocumentoEntregado,  $entrega->fechaInicio, $entrega->fechaEntregado, $entrega->indicaciones, $entrega->direccionEntregaNombre, $entrega->id);
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
