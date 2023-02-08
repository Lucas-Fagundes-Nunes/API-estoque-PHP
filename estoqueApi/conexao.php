<?php

$host = "localhost";
$dbname = "estoque_api";
$user = "root";
$pass = "";

$pdo = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);


date_default_timezone_set('America/Sao_Paulo');
$data = date("d/m/Y H:i:s");
?>