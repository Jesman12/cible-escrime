<?php
include("clases/conect.php");
$mensaje = $_POST['mensaje'];
$tipo = $_POST['tipo'];

$timestamp = date("Y-m-d H:i:s");

$q = "INSERT INTO mensajes (mensaje,timestamp,status,tipo) VALUES('$mensaje','$timestamp','1','$tipo')";
if($conexion->query($q) === true){
	echo "Realizado!";
}else{
	die("Error 1: " . $conexion->error);
}
header("Location: form.php");
?>