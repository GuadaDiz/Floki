<?php
// include "db.php";

class dbMysql extends Db
{
  protected $conection;

  public function __construct()
  {
    $config = file_get_contents("config.json");
    $configArray = json_decode($config, true);
    $dbName = $configArray["dbName"];
    $dbPort = $configArray["dbPort"];
    $dbUser = $configArray["dbUser"];
    $dbPass = $configArray["dbPass"];

    $dsn = "mysql:host=localhost;dbname=$dbName;port=$dbPort";

    try {
      $this->conection = new PDO($dsn, $dbUser, $dbPass);
      $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (\Exception $e) {
      echo "Hubo un error <br>";
      echo $e->getMessage();
      exit;
    }
  }

  public function guardarUsuario(Usuario $usuario)
{
    $stmt = $this->conection->prepare("INSERT into usuarios VALUES(default, :nombre, :apellido, :email, :pass, default, default, default, :news)");
    $stmt->bindValue(":nombre", $usuario->getNombre());
    $stmt->bindValue(":apellido", $usuario->getApellido());
    $stmt->bindValue(":email", $usuario->getEmail());
    $stmt->bindValue(":pass", $usuario->getPassword());
    $stmt->bindValue(":news", $usuario->getNews());
    $stmt->execute();
}

public function comprobarUsuario($email)
{
    $usuarios = $this->conection->prepare("SELECT * FROM usuarios WHERE :email = usuarios.email ");
    $usuarios->bindValue(":email", $email);
    $usuarios->execute();
    $user = $usuarios->fetch(PDO::FETCH_ASSOC);

    if($user==false){
      return NULL;
    } else {
      $usuario = new Usuario($user);
      return $usuario;
    }
}

public function existeElUsuario($email){
  return $this->comprobarUsuario($email) !== null;
}


function listaDeUsuarios()
{
    $usuarios = $this->conection->prepare("SELECT * FROM usuarios");
    $usuarios->execute();
    $usuariosAll = $usuarios->fetchAll(PDO::FETCH_ASSOC);
    return $usuariosAll;
}

function actualizarUsuario($user)
{    
    $email = $_SESSION["email"];
    $stmt = $this->conection->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento WHERE email = '$email'");
    $stmt->bindValue(":nombre", $user->getNombre());
    $stmt->bindValue(":apellido", $user->getApellido());
    $stmt->bindValue(":telefono", $user->getTelefono());
    $stmt->bindValue(":fecha_nacimiento", $user->getCumple());
    $stmt->execute();
}


}