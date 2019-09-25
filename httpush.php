<?php
	require_once('clases/conect.php');
	set_time_limit(0); //Establece el número de segundos que se permite la ejecución de un script.

	$info = "SELECT * FROM mensajes";
	$datos_query = $conexion->query($info);

	if($datos_query->num_rows > 0){	
		while ($row = $datos_query->fetch_assoc()) {
			$ar["timestamp"]          = 5;	
			$ar["mensaje"] 	 		  = "HOLA";	
			$ar["id"] 		          = "1";	
			$ar["status"]           = "1";	
			$ar["tipo"]           = $row["tipo"];	
		}
	}
	$dato_json   = json_encode($ar);
	echo $dato_json;
?>