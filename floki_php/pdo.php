<?php
$dsn = "mysql:host=127.0.0.1;dbname=movies_db;port=3306";
$user = "root";
$pass = ""; 

try{
$db = new PDO($dsn, $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo"todo bien";
} catch(\Exception $e) {
    echo $e->getMessage();
}