<?php

require_once __DIR__ . "/conexion/dao.php";
class Usuarios extends DAO
{
    public function __construct()
    {
    }

    public function traerDatos()
    {
        $datos = $this->read("usuarios", "*");
        return $datos;
    }
    public function buscarUsuario($user)
    {
        $datos = $this->read("usuarios", "*", array($user), "usuario=?");
        return $datos;
    }


    public function crearUsuario($datos)
    {
        return $this->create("usuarios(nombre, usuario, pass)", $datos);
    }
    public function actualizarUsuarios($datos)
    {
        return $this->update("usuarios", $datos);
    }
    public function eliminarUsuario($id)
    {
        return $this->delete("usuarios", "id", $id);
    }
}
