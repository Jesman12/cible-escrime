<?php
$sevidor = "localhost";
$usuario = "pi";		//pi
$pass = "raspberry";	//raspberry
$db = "chat";

$conexion = new mysqli($sevidor, $usuario, $pass, $db);
if($conexion->connect_error){
	die("Conexion Fallida: " . $conexion->connect_error);
}
?>
