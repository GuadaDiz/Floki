<?php
include_once "conexion.php";

session_start();

function comprobarUsuario($email)
{
    // if (!file_exists("db.json")) {
    //     $usuarios = "";
    // } else {
    //     $usuarios = file_get_contents("db.json");
    // }

    // if ($usuarios == "") {
    //     return null;
    // }

    // $array = json_decode($usuarios, true);
    // foreach ($array["usuarios"] as $usuario) {
    //     if ($email == $usuario["email"]) {
    //         return $usuario;
    //     }
    // }

    // return null;
    global $db;
    $usuarios = $db->prepare("SELECT * FROM usuarios WHERE :email = usuarios.email ");
    $usuarios->bindValue(":email", $email);
    $usuarios->execute();
    $usuario = $usuarios->fetch(PDO::FETCH_ASSOC);
    return $usuario;
}

// function existeElUsuario($email)
// {
//     return comprobarUsuario($email) !== null;
// }

function validarRegistro($datos)
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
    if (empty($datos["email"])) {
        $errores["email"] = "Por favor ingrese su email";
    } else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false) {
        $errores["email"] = "Por favor use el formato: usuario@ejemplo.com";
    } elseif (comprobarUsuario($datosFinales["email"])) {
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

// function lastId()
// {
//     $json = file_get_contents("db.json");
//     $array = json_decode($json, true);

//     if ($json == "") {
//         return $lastId = 1;
//     }
//     $ultimoElemento = array_pop($array["usuarios"]);
//     $lastId = $ultimoElemento["id"] + 1;
//     return $lastId;
// }

function armarUsuario($datos)
{
    if (isset($datos["news"])) {
        return [
            // "id" => lastId(),
            "nombre" => trim($datos["nombre"]),
            "apellido" => trim($datos["apellido"]),
            "email" => trim($datos["email"]),
            "pass" => password_hash($datos["pass"], PASSWORD_DEFAULT),
            "news" => 0
        ];
    } else {
        return [

            "nombre" => trim($datos["nombre"]),
            "apellido" => trim($datos["apellido"]),
            "email" => trim($datos["email"]),
            "pass" => password_hash($datos["pass"], PASSWORD_DEFAULT),
            "news" => 1
        ];
    }
}
function guardarUsuario($user)
{
    // $json = file_get_contents("db.json");
    // $array = json_decode($json, true);
    // $array["usuarios"][] = $user;
    // $array = json_encode($array, JSON_PRETTY_PRINT);
    // file_put_contents("db.json", $array);
    global $db;
    $usuario = $db->prepare("INSERT into usuarios VALUES(default, :nombre, :apellido, :email, :pass, default, default, default, :news)");
    $usuario->bindValue(":nombre", $user["nombre"]);
    $usuario->bindValue(":apellido", $user["apellido"]);
    $usuario->bindValue(":email", $user["email"]);
    $usuario->bindValue(":pass", $user["pass"]);
    $usuario->bindValue(":news", $user["news"]);
    $usuario->execute();
}

function validarLogin($datos)
{
    $errores = [];
    $datosFinales = [];
    foreach ($datos as $posicion => $valor) {
        $datosFinales[$posicion] = trim($valor);
    }
    if (empty($datos["email"])) {
        $errores["email"] = "Por favor ingrese su email";
    } else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false) {
        $errores["email"] = "Por favor use el formato: usuario@ejemplo.com";
    } elseif (!comprobarUsuario($datos["email"])) {
        $errores["email"] = "El email no está registrado";
    }
    $usuario = comprobarUsuario($datos["email"]);
    if (empty($datos["pass"])) {
        $errores["pass"] = "Por favor ingrese su contraseña";
    } else if (!password_verify($datos["pass"], $usuario["pass"])) {
        $errores["pass"] = "La contraseña no es correcta";
    }
    return $errores;
}

function validarPerfil($datos)
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

function listaDeUsuarios()
{
    // $json = file_get_contents("db.json");
    // $array = json_decode($json, true);

    // return $array;
    global $db;
    $usuarios = $db->prepare("SELECT * FROM usuarios");
    $usuarios->execute();
    $usuariosAll = $usuarios->fetchAll(PDO::FETCH_ASSOC);
    return $usuariosAll;
}

function loguearUsuario($user)
{
    $usuario = comprobarUsuario($user["email"]);
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["apellido"] = $usuario["apellido"];
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["cumple"] = $usuario["cumple"];
    $_SESSION["telefono"] = $usuario["telefono"];
}

function traerUsuarioLogueado()
{
    if (isset($_SESSION["email"])) {
        return comprobarUsuario($_SESSION["email"]);
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

function actualizarUsuario($user)
{
    $email = $_SESSION["email"];
    $usuarioActualizado = [
        "nombre" => trim($user["nombre"]),
        "apellido" => trim($user["apellido"]),
        "telefono"  => $user["telefono"],
        "fecha_nacimiento" => $user["cumple"],
    ];
    // $json = file_get_contents("db.json");
    // $array = json_decode($json, true);

    // foreach ($array["usuarios"] as $usuario) {
    //     if ($_SESSION["id"] == $usuario["id"]) {
    //         $usuario["nombre"] = $usuarioActualizado["nombre"];
    //         $usuario["apellido"] = $usuarioActualizado["apellido"];
    //         $usuario["cumple"] = $usuarioActualizado["cumple"];
    //     };
    //     $array["usuarios"][$usuario["id"]] = $usuario;
    // }
    // $array = json_encode($array, JSON_PRETTY_PRINT);
    // file_put_contents("db.json", $array);
    global $db;
    $stmt = $db->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento WHERE email = '$email'");
    $stmt->bindValue(":nombre", $usuarioActualizado["nombre"]);
    $stmt->bindValue(":apellido", $usuarioActualizado["apellido"]);
    $stmt->bindValue(":telefono", $usuarioActualizado["telefono"]);
    $stmt->bindValue("fecha_nacimiento", $usuarioActualizado["fecha_nacimiento"]);
    $stmt->execute();
}
// function validarAvatar($archivo)
// {
//     $errorAvatar = "";

//     if ($archivo["avatar"]["error"] !== UPLOAD_ERR_OK) {
//         $errorAvatar = "Hubo un error al subir la imagen";
//     }

//     $extension = pathinfo($archivo["avatar"]["name"], PATHINFO_EXTENSION);
//     if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
//         $errorAvatar = "Formatos permitidos: png, jpg o jpeg.";
//     }

//     return $errorAvatar;
// }

// function guardarAvatar($archivos)
// {
//     $ext = pathinfo($archivos["avatar"]["name"], PATHINFO_EXTENSION);
//     $file = "./images/img/avatar" . $_POST["nombre"] . $_POST["apellido"] . "." . $ext;
//     move_uploaded_file($archivos["avatar"]["tmp_name"], $file);
// }
