<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Receptor de Datos</title>
	</head>
	<body>
		<form name="datos" action="insertar.php" method="post">
			<input type="text" id="jugador" name="tipo" placeholder="JUGADOR" />
			<input type="text" id="puntos" name="mensaje" placeholder="BTN" />
			<input type="submit" value="enviar" />
		</form>
		<button style="width:150px; height:150px" onclick="CIBLE(3)">CIBLE <b>G</b></button>
		<button style="width:150px; height:150px" onclick="CIBLE(2)">CIBLE <b>M</b></button><br>
		<button style="width:150px; height:150px" onclick="CIBLE(1)">CIBLE <b>C</b></button>
		<form name="TEST_datos" action="insertar.php" method="post">
			<input type="text" id="TEST_jugador" name="tipo" placeholder=" TEST JUGADOR"/>
			<input type="text" id="TEST_puntos" name="mensaje" placeholder="TEST BTN" />
		</form>
		<?php
		include("clases/conect.php");
			if (isset($_GET["id"])) {
				echo '¡NUEVO REGISTRO DE ID: <b>' . htmlspecialchars($_GET["id"]) . '</b>!<br>';
				if (isset($_GET["btn"])) {
					echo 'Boton presionado: <b>' . htmlspecialchars($_GET["btn"]) . '</b>!<br>';
					if (isset($_GET["jeu"])){
						echo 'Juego Elegido: <b>' . htmlspecialchars($_GET["jeu"]) . '</b>!';
						$timestamp = date("Y-m-d H:i:s");
						$mensaje = $_GET["btn"];
						$tipo = $_GET["id"];
						$jeu = $_GET["jeu"];
						$q = "INSERT INTO mensajes (mensaje,timestamp,status,tipo) VALUES('$mensaje','$timestamp','$jeu','$tipo')";
						if($conexion->query($q) === true){
							echo "Realizado!";
						}else{
							die("Error 1: " . $conexion->error);
						}
					}
				}
			}
		?>
		<script type='text/javascript'>
		function CIBLE(btn){
			document.getElementById('TEST_jugador').value = '1';					
			document.getElementById('TEST_puntos').value = btn;
			document.TEST_datos.submit();
		}
		</script>
	</body>
</html>