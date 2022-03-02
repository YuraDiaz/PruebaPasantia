<?php
require_once("../model/usuarios.php");
$us = new Usuarios();


$usuario = $_POST["usuario"];
$contra = $_POST["pass"];
$datosUser = $us->buscarUsuario($usuario);

if (count($datosUser) > 0) {
    $contra_almacenada = $datosUser[0]["pass"];
    if (password_verify($contra, $contra_almacenada)) {
        session_start();
        $_SESSION["user"] = $datosUser[0]["usuario"];
        die("1");
    } else {
        die("0");
    }
} else {
    die("0");
}
