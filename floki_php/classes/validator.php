<?php

// require_once ("classes/dbmysql.php");
// require_once ("classes/dbjson.php");


class Validator {

public static function validarRegistro($datos)
{
    global $dbMysql;

    $errores = [];
    $datosFinales = [];
    foreach ($datos as $posicion => $valor) {
        $datosFinales[$posicion] = trim($valor);
    }
    if (empty($datosFinales["nombre"])) {
        $errores["nombre"] = "Por favor ingrese su nombre";
    } elseif (!preg_match('/^(\s)*[\p{L}-]+((\s)?((\'|\-)?([\p{L}-])+))*(\s)*$/u', ($datosFinales["nombre"]))) {
        $errores["nombre"] = "El campo nombre debe contener solo letras";
    }
    if (empty($datosFinales["apellido"])) {
        $errores["apellido"] = "Por favor ingrese su apellido ";
    } elseif (!preg_match('/^(\s)*[\p{L}-]+((\s)?((\'|\-)?([\p{L}-])+))*(\s)*$/u', ($datosFinales["apellido"]))) {
        $errores["apellido"] = "El campo apellido debe contener solo letras";
    }
    if (empty($datos["email"])) {
        $errores["email"] = "Por favor ingrese su email";
    } else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false) {
        $errores["email"] = "Por favor use el formato: usuario@ejemplo.com";
    } elseif ($dbMysql->comprobarUsuario($datosFinales["email"])) {
        $errores["email"] = "Ya existe un usuario con este email";
    }

    if (empty($datos["pass"])) {
        $errores["pass"] = "Por favor complete la contraseña";
    } else if (strlen($datos["pass"]) < 8) {
        $errores["pass"] = "La contraseña debe tener al menos 8 caracteres";
    } else if (!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])/', $datos["pass"])) {
        $errores["pass"] = "Incluya una minúscula, una mayúscula y un número";
    }
    if (empty($datos["pass2"])) {
        $errores["pass2"] = "Por favor complete la contraseña";
    } else if ($datos["pass"] !== $datos["pass2"]) {
        $errores["pass2"] = "Las contraseñas no coinciden";
    }
    if (empty($datos["tyc"])) {
        $errores["tyc"] = "Por favor acepte los términos y condiciones";
    }
    return $errores;
}

public static function validarLogin($datos)
{
    global $dbMysql;

    $errores = [];
    $datosFinales = [];
    foreach ($datos as $posicion => $valor) {
        $datosFinales[$posicion] = trim($valor);
    }
    if (empty($datos["email"])) {
        $errores["email"] = "Por favor ingrese su email";
    } else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false) {
        $errores["email"] = "Por favor use el formato: usuario@ejemplo.com";
    } elseif (!$dbMysql->comprobarUsuario($datos["email"])) {
        $errores["email"] = "El email no está registrado";
    }
    $usuario = $dbMysql->comprobarUsuario($datos["email"]);
    if (empty($datos["pass"])) {
        $errores["pass"] = "Por favor ingrese su contraseña";
    } else if (!password_verify($datos["pass"], $usuario->getPassword())) {
        $errores["pass"] = "La contraseña no es correcta";
    }
    return $errores;
}

public static function validarPerfil($datos)
{
    $errores = [];
    $datosFinales = [];
    foreach ($datos as $posicion => $valor) {
        $datosFinales[$posicion] = trim($valor);
    }
    if (empty($datosFinales["nombre"])) {
        $errores["nombre"] = "Por favor ingrese su nombre";
    } elseif (!preg_match('/^(\s)*[\p{L}-]+((\s)?((\'|\-)?([\p{L}-])+))*(\s)*$/u', ($datosFinales["nombre"]))) {
        $errores["nombre"] = "El campo nombre debe contener solo letras";
    }

    if (empty($datosFinales["apellido"])) {
        $errores["apellido"] = "Por favor ingrese su apellido ";
    } elseif (!preg_match('/^(\s)*[\p{L}-]+((\s)?((\'|\-)?([\p{L}-])+))*(\s)*$/u', ($datosFinales["apellido"]))) {
        $errores["apellido"] = "El campo apellido debe contener solo letras";
    }

    if (empty($datosFinales["telefono"])) {
        $errores["telefono"] = "Por favor ingrese su teléfono ";
    } elseif (!is_numeric($datos["telefono"])) {
        $errores["telefono"] = "Ingrese un número válido";
    }elseif($datos["telefono"]>99999999999){
        $errores["telefono"] = "Máximo 11 caracteres";
    }

    if (empty($datosFinales["cumple"])) {
        $errores["cumple"] = "Por favor complete este campo ";
    } elseif (!preg_match('/^[1-2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]$/', ($datos["cumple"]))) {
        $errores["cumple"] = "Ingrese una fecha válida. Formato YYYY-MM-DD";
    }
    return $errores;
}

}

?>