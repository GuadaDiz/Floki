<?php

class Usuario {

    protected $id;
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $pass;
    protected $news;
    protected $telefono;
    protected $cumple;

    function __construct(Array $datos)
    {
        if(isset($datos["id"])){
            $this->id = $datos["id"];
            $this->pass = $datos["pass"];
        } else {
            $this->id = NULL;
            $this->pass = password_hash($datos["pass"], PASSWORD_DEFAULT);
        }

        if(isset($datos["news"])){
            $this->news = 1;
        } else {
            $this->news = 0;
        }

        if(isset($datos["telefono"])){
            $this->telefono = $datos["telefono"];
        }else{
            $this->telefono = NULL;
        }

        if(isset($datos["cumple"])){
            $this->cumple = $datos["cumple"];
        } else {
            $this->cumple = NULL;
        }

        $this->nombre = trim($datos["nombre"]);
        $this->apellido = trim($datos["apellido"]);
        $this->email = trim($datos["email"]);
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->pass;
    }

    public function getNews(){
        return $this->news;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getCumple(){
        return $this->cumple;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
        return $this;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function setPassword($pass){
        $this->pass = $pass;
        return $this;
    }

    public function setNews($news){
        $this->news = $news;
        return $this;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
        return $this;
    }


    public function setCumple($cumple){
        $this->cumple = $cumple;
        return $this;
    }


}


