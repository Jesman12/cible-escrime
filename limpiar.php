<?php
	header('Location:index.php');
	include("clases/conect.php");
	$vaciar = "TRUNCATE TABLE mensajes";
	$dato1 = "INSERT INTO mensajes (mensaje,status,tipo) VALUES('0','0','1')";
	$truncate = $conexion->query($vaciar);
	$info = $conexion->query($dato1);
?>