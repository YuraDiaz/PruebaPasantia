<?php
require_once("../model/usuarios.php");
$opcion = $_POST["opcion"];
$usuario = new Usuarios();


switch ($opcion) {
    case 'insertar':
        if (count($usuario->buscarUsuario($_POST["usuario"])) > 0) {

            $pass = password_hash($_POST["pass"], PASSWORD_BCRYPT);
            $datos = [$_POST["nombre"], $_POST["usuario"], $pass];
            if ($usuario->crearUsuario($datos)) {
                die("1");
            } else {
                die("0");
            }
        } else {
            die("0");
        }

        break;


    case 'mostrar':
        die(json_encode($usuario->traerDatos()));
        break;
    case 'eliminar':
        if ($usuario->eliminarUsuario($_POST["id"])) {
            die("1");
        } else {
            die("0");
        }
        break;
    case 'actualizar':
        $datos = [
            "nombre" => $_POST["nombre"],
            "usuario" => $_POST["usuario"],
            "id" => $_POST["id"]
        ];
        if ($usuario->actualizarUsuarios($datos)) {
            die("1");
        } else {
            die("0");
        }

        break;
}
