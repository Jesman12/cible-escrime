	var a = 0;
	var b = 0;
	var c = 0;
	FIN = false;
function getRandomInt(max){
		return Math.floor(Math.random() * Math.floor(max));
	}
function MARATHON() 
{
	document.getElementById('jeu_select').innerHTML = "MARATHON";
	document.getElementById('status_cible').style.display = "block";
	if(seg){
		start();
		document.getElementById('status').style.display = 'block';
		seg = false;
		FIN = false;
	}
	function LED_rand(){
		a = getRandomInt(2);
		b = getRandomInt(2);
		c = getRandomInt(2);
	}
	LED_rand();
	if(!FIN){
		if(a == 0 && b == 0 && c == 0){
			LED_rand();
		}else{
			for(var cb = 0; cb <= CIBLES_POUR_JOUER.length-1; cb++){
				if(vinc == 'DIFFERENT'){
					LED_rand();
				}
				$.ajax({
					async:	true, 
					type: "GET",
					url: "http://"+CIBLES_POUR_JOUER[cb],
					data: "LED="+a+b+c,
					dataType:"html"
				});
			}
		}
		setTimeout('MARATHON()',2000);
	}else{
		for(var cb = 0; cb <= CIBLES_POUR_JOUER.length-1; cb++){
			$.ajax({
					async:	true, 
					type: "GET",
					url: "http://"+CIBLES_POUR_JOUER[cb],
					data: "Start",
					dataType:"html"
				});
			seg = true;
		}
	}
}
function CONTRAT(){
	document.getElementById('jeu_select').innerHTML = "CONTRAT";
	document.getElementById('status_cible').style.display = "block";
	var LED_activo = ["001","010","100"];
	var indicador = 0;
	if(seg){
		start();
		document.getElementById('status').style.display = 'block';
		seg = false;
		FIN = false;
	}
	indicador = getRandomInt(3);
	if(!FIN){
		for(var cb = 0; cb <= CIBLES_POUR_JOUER.length-1; cb++){
			if(vinc == 'DIFFERENT'){
				indicador = getRandomInt(3);
			}
			$.ajax({
				async:	true, 
				type: "GET",
				url: "http://"+CIBLES_POUR_JOUER[cb],
				data: "LED="+LED_activo[indicador]+"&jeu=2",
				dataType:"html"
			});
		}
		setTimeout('CONTRAT()',2000);
	}else{
		for(var cb = 0; cb <= CIBLES_POUR_JOUER.length-1; cb++){
			$.ajax({
					async:	true, 
					type: "GET",
					url: "http://"+CIBLES_POUR_JOUER[cb],
					data: "Start",
					dataType:"html"
				});
			seg = true;
		}
	}
}