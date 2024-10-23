<?php
$servidor = "localhost";
$username = "root";
$password = "";
$basededados = "graficos";


$conn = new mysqli($servidor, $username, $password, $basededados);
global $conn;

mysqli_set_charset($conn, "utf8");
date_default_timezone_set("Europe/Lisbon");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
?>