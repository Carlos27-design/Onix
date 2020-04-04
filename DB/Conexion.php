<?php
class Conexion
{
    public $miConexion;

    function conectar()
    {
        $this->miConexion = new mysqli("localhost", "root", "password", "onix");
        if ($this->miConexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->miConexion->connect_errno . ") ";
        }
    }

    function desconectar()
    {
        if ($this->miConexion != null) {
            $this->miConexion->close();
        }
    }
}
