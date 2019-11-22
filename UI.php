<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
	body,h1 {font-family: "Raleway", sans-serif}
	body, html {height: 100%}
	.bgimg {
	  background-image: url('http://www.cubahora.cu/uploads/imagen/2018/06/20/por-estos-dias-se-desarrolla-en-la-habana-el-campeonato-panamericano-de-esgrima-foto-abel-rojas-barallobre-7.JPG');
	  min-height: 100%;
	  background-position: center;
	  background-size: cover;
	}
	.city {display:none}
</style>
<body>

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-topleft w3-padding-large w3-xlarge">
    Logo
  </div>
  <div class="w3-display-topright w3-padding-large w3-xlarge">
	<button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">SCAN</button>
	<button class="w3-btn">SCAN</button>
  </div>
  <div id="id01" class="w3-modal" style="color:black;">
 <div class="w3-modal-content w3-card-4 w3-animate-zoom">
  <header class="w3-container w3-blue"> 
   <span onclick="document.getElementById('id01').style.display='none'" 
   class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
   <h2>Header</h2>
  </header>

  <div class="w3-bar w3-border-bottom">
   <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Trouve')">TROUVÉ</button>
   <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Conenecte')">CONNECTÉ</button>
   <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Avances')">AVANCÉS</button>
  </div>

  <div id="Trouve" class="w3-container city">
   <h1>TROUVÉ</h1>
		<div id="scan" class="w3-center" style="display:block;">
		<button>EJEMPLO</button>
			<!--(ES-MX) SE MUESTRA LA IP DEL USUARIO
				(ES-MX) SI SE CONECTA CON EL "CIBLE" SE MUESTRA LA IP DEL CIBLE CONECTADO-->
			<!--<p>VOTRE ADRESSE IP EST: <a id="IP_Servidor"><?Php //echo "$ip";?></a></p>-->
			<p style="display:none"><a id="IP_Base"><?Php echo "http://$addres";?></a></p>
			<!--
			<p>IP: <b><a id="Dir_IP" class="w3-green"></a></b></p>-->
			<p style="display:none"><a id="error"></a></p>
			<div id="success">
				<!--(ES-MX) SE LISTAN TODOS LOS CIBLES DISPONIBLES EN LA RED-->
			</div>
		</div>
  </div>

  <div id="Conenecte" class="w3-container city">
   <h1>CONNECTÉ</h1>
   <p>Paris is the capital of France.</p>
   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
  </div>

  <div id="Avances" class="w3-container city">
   <h1>PARAMÈTRES AVANCÉS</h1>
   <p>Tokyo is the capital of Japan.</p><br>
  </div>

  <div class="w3-container w3-light-grey w3-padding">
   <button class="w3-button w3-right w3-white w3-border" onclick="document.getElementById('id01').style.display='none'">Close</button>
  </div>
 </div>
</div>
  <div id="JOUER" class="w3-display-middle w3-center">
	<button class="w3-jumbo w3-animate-top w3-btn w3-round-xlarge w3-yellow" onclick="document.getElementById('JOUER').style.display='none'">JOUER</button>
	<br>
	<br>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <p class="w3-large w3-center">Fédération Française d'Escrime</p>
  </div>
  <div id="JOUER" class="w3-display-middle w3-center">
	<button class="w3-jumbo w3-animate-top w3-btn w3-round-xlarge w3-yellow" onclick="document.getElementById('JOUER').style.display='none'">JOUER</button>
	<br>
	<br>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <p class="w3-large w3-center">Fédération Française d'Escrime</p>
  </div>
  <div class="w3-display-bottomleft w3-padding-large">
    Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a>
  </div>
  <div class="w3-display-bottomright w3-padding-large">
    Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a>
  </div>
</div>

<script>
document.getElementsByClassName("tablink")[0].click();

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].classList.remove("w3-light-grey");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.classList.add("w3-light-grey");
}
</script>

</body>
</html>