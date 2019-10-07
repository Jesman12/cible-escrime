<?php
$sevidor = "localhost";
$usuario = "domintco_jesman";
$pass = "jesman1224@";
$db = "domintco_domint";

$conexion = new mysqli($sevidor, $usuario, $pass, $db);
if($conexion->connect_error){
	die("Conexion Fallida: " . $conexion->connect_error);
}
?>
