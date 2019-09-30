<?php
	include("clases/conect.php");
	$info = "SELECT * FROM mensajes";
	$datos_query = $conexion->query($info);

	if($datos_query->num_rows > 0){	
		while ($row = $datos_query->fetch_assoc()) {
			if ($row['mensaje'] == 1) {
				$pts = 5;
			}else if ($row['mensaje'] == 2) {
				$pts = 2;
			}else if ($row['mensaje'] == 3) {
				$pts = 1;
			}else if ($row['mensaje'] == 4) {
				$pts = 3;
			}else{
				$pts = 0;
			}
			if ($row['status'] == 1) {
				$jeu = "Marathon (1)";
			}else if ($row['status'] == 2) {
				$jeu = "Contrat (2)";
			}else if ($row['status'] == 3) {
				$jeu = "Tourniquet (3)";
			}else{
				$jeu = 0;
			}
			echo "<p style='display:none;' class='pts" .$pts." j" .$row['tipo']."''>BTN: ".$row['mensaje'] . " <br>PUNTOS= ". $pts ." <br>Jeu= ". $jeu ." </p>";
		}
	}
?>