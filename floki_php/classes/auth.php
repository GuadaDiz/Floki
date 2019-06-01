<?php


class Auth
{

    function __construct()
    {
        session_start();
    }

    function loguearUsuario($user)
    {
        global $dbMysql;
        global $dbJson;

        $usuarioJson = $dbJson->comprobarUsuario($user["email"]);
        var_dump($usuarioJson);
        $usuario = $dbMysql->comprobarUsuario($user["email"]);
        $_SESSION["email"] = $usuario->getEmail();
        $_SESSION["nombre"] = $usuario->getNombre();
        $_SESSION["apellido"] = $usuario->getApellido();
        $_SESSION["id"] = $usuario->getId();
        $_SESSION["cumple"] = $usuario->getCumple();
        $_SESSION["telefono"] = $usuario->getTelefono();
    }

    function traerUsuarioLogueado()
    {
        global $dbMysql;

        if (isset($_SESSION["email"])) {
            return $dbMysql->comprobarUsuario($_SESSION["email"]);
        }
        return false;
    }

    function usuarioLogueado()
    {
        return isset($_SESSION["email"]);
    }

    function logOut()
    {
        session_start();
        session_destroy();
        setcookie("user", "", -1);
        header("Location: home.php");
    }
}
