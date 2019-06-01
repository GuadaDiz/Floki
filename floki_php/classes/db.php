<?php
include "usuario.php";

abstract class Db
{
  public abstract function guardarUsuario(Usuario $usuario);
  public abstract function comprobarUsuario($email);
}
