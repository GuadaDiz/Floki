<?php
require_once("classes/validator.php");
require_once("classes/dbmysql.php");
require_once("classes/dbjson.php");
//require_once("classes/db.php");
include("classes/auth.php");
$dbMysql = new dbMysql;
$dbJson = new dbJson;
$auth = new Auth;

?>
