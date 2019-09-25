<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Receptor de Datos</title>
	</head>
	<body>
		<form name="datos" action="insertar.php" method="post">
			<input type="text" id="jugador" name="tipo" placeholder="JUGADOR" />
			<input type="text" id="puntos" name="mensaje" placeholder="BTN" />
			<input type="submit" value="enviar" />
		</form>
		<?php
			if (isset($_GET["id"])) {
				echo '¡NUEVO REGISTRO DE ID: <b>' . htmlspecialchars($_GET["id"]) . '</b>!<br>';
				if (isset($_GET["btn"])) {
					echo 'Boton presionado: <b>' . htmlspecialchars($_GET["btn"]) . '</b>!';
					echo "
					<script type='text/javascript'>
						document.getElementById('jugador').value = '" . $_GET["id"] ."';					
						document.getElementById('puntos').value = '" . $_GET["btn"] ."';
						document.datos.submit();
					</script>
					";
				}
			}
		?>
	</body>
</html>