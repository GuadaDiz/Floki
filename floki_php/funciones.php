<?php

function comprobarUsuario($email){
    
    $json =file_get_contents("db.json");
    $array = json_decode($json, true);
    foreach ($array as $usuarios => $usuario) {
        foreach ($usuario as $datos) {
            if($datos["email"] == $email){
                $respuesta = true; 
             } else {
                 $respuesta = false;
             }
          } return $respuesta;
            
        }
    } 
function validar($datos){
    $errores = [];
    $datosFinales = [];
    foreach ($datos as $posicion => $valor) {
        $datosFinales[$posicion] = trim($valor);
    }

   if(empty($datosFinales["nombre"])){
    $errores["nombre"] = "Por favor ingrese su nombre";
    } elseif(!preg_match('/^[\p{L}-]*$/u', ($datosFinales["nombre"]))) {
        $errores["nombre"] = "El campo nombre debe contener solo letras";
    }

   if(empty($datosFinales["apellido"])){
    $errores["apellido"] = "Por favor ingrese su apellido ";
   } elseif(!preg_match('/^[\p{L}-]*$/u', ($datosFinales["apellido"]))) {
    $errores["apellido"] = "El campo apellido debe contener solo letras";
}

   if(empty($datos["email"])){
       $errores["email"] = "Por favor ingrese su email";
   } else if(filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false) {
       $errores["email"] = "Por favor use el formato: usuario@ejemplo.com";}
   elseif (comprobarUsuario($datosFinales["email"])) {
       $errores["email"] = "Ya existe un usuario con este email";
   }

   if(empty($datos["pass"])){
       $errores["pass"] = "Por favor complete la contraseña";
   }else if(strlen($datos["pass"])<8){
       $errores["pass"] = "La contraseña debe tener al menos 8 caracteres";
   }else if(!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])/', $datos["pass"])){
        $errores["pass"] = "Incluya una minúscula, una mayúscula y un número";
   }

   if(empty($datos["pass2"])){
       $errores["pass2"] = "Por favor complete la contraseña";
   }
   else if($datos["pass"]!== $datos["pass2"]){
       $errores["pass2"] = "Las contraseñas no coinciden";
   }

   if(empty($datos["tyc"])){
       $errores["tyc"] = "Por favor acepte los términos y condiciones";
   }

    return $errores;          
}

function lastId(){

    $json =file_get_contents("db.json");
    $array = json_decode($json, true);

    if($json==""){
        return $lastId = 0;
    }
    $ultimoElemento =array_pop($array["usuarios"]);
    $lastId= $ultimoElemento["id"] + 1;
    return $lastId;
}

function armarUsuario($datos){
    return [
        "id" => lastId(),
        "nombre" => trim($datos["nombre"]),
        "apellido" =>trim($datos["apellido"]),
        "email" => trim($datos["email"]),
        "pass" => password_hash($datos["pass"], PASSWORD_DEFAULT)
    ];
}

function guardarUsuario($user){
    $json =file_get_contents("db.json");
    $array = json_decode($json, true);
    $array ["usuarios"][] = $user;
    $array = json_encode($array, JSON_PRETTY_PRINT);
    file_put_contents("db.json", $array);
}


?>