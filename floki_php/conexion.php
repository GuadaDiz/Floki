<?php
$dsn = "mysql:host=127.0.0.1;dbname=db_floki;port=3306";
$user = "root";
$pass = ""; 

try{
$db = new PDO($dsn, $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(\Exception $e) {
    echo $e->getMessage();
}
?>