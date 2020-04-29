<?php
class Conexion
{
    public $miConexion;

    function conectar()
    {
        $this->miConexion = new mysqli("localhost", "root", "Desector123", "onix");
        if ($this->miConexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->miConexion->connect_errno . ") ";
        }
        mysqli_set_charset($this->miConexion, 'utf8');
    }

    function desconectar()
    {
        if ($this->miConexion != null) {
            $this->miConexion->close();
        }
    }
}
