<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script language="javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script language="javascript">
var timestamp = null;
function cargar_push() 
{ 
	$.ajax({
	async:	true, 
    type: "POST",
    url: "httpush.php",
    data: "&timestamp="+timestamp,
	dataType:"html",
    success: function(data)
	{	
		var json    	   = eval("(" + data + ")");
		timestamp 		   = json.timestamp;
		mensaje     	   = json.mensaje;
		id        		   = json.id;
		status      	   = json.status;
		tipo      	   	   = json.tipo;
		
		if(timestamp == null)
		{
		
		}
		else
		{
			$.ajax({
			async:	true, 
			type: "POST",
			url: "mensajes.php",
			data: "",
			dataType:"html",
			success: function(data)
			{	
				$('#div'+tipo).html(data);
				$('#div'+tipo).children('.j'+tipo).css("display", "block");
			}
			});	
		}
		setTimeout('cargar_push()',1000);
		    	
    }
	});		
}

$(document).ready(function()
{
	cargar_push();
});	 

</script>

</head>

<body>
	<p id="ptsJ1">PTS 1</p>
	<p id="ptsJ2">PTS 2</p>
<div id="div1" style="width:200px; height:200px; float:left;">
div 1
</div>
<div id="div2" style="width:200px; height:200px; float:left;">
div 2
</div>

<script type="text/javascript">
var x = document.getElementsByClassName('j1');
for(var i = 0; i <= x.length; i++){
	x[0].getAttribute("class");
	document.getElementById("ptsJ1").innerHTML = x[i];
}	
</script>

</body>
</html>