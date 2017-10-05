<!DOCTYPE html>
<html>
<head>
	<?php $chat = new chat; ?>
	<title>Transito Juiz de Fora</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/inicial.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#enviarM').submit(function(){
				var dados = jQuery( this ).serialize();

				jQuery.ajax({
					type: "POST",
					url: "forms/inserir.php",
					data: dados,
					success: function( data )
					{
						$("#topo_input_form").val("");
						requisitar();
					}
				});
				return false;
			});
		});
	</script>
	<script type="text/javascript" src="scripts/jquery.slimscroll.min.js"></script>
</head>
<body>
	<div class="background"></div>
	<div class="topo" id="topo">
		<content id="topo_menu">
			<img id="topo_img" src="css/transito_ico.jpg">
			<a id="topo_titulo">Transito JF</a>
			<button id="btn_pesquisa" title="Buscar..."><span data-icon="search-alt" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".5" d="M15.9 14.3H15l-.3-.3c1-1.1 1.6-2.7 1.6-4.3 0-3.7-3-6.7-6.7-6.7S3 6 3 9.7s3 6.7 6.7 6.7c1.6 0 3.2-.6 4.3-1.6l.3.3v.8l5.1 5.1 1.5-1.5-5-5.2zm-6.2 0c-2.6 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6 4.6 2.1 4.6 4.6-2 4.6-4.6 4.6z"></path></svg></span></button>
		</content>
		<div class="centro" id="centro">
			<div class="circle"></div>
		</div>
		<content id="topo_input">
			<button id="buton" class="compose-btn-emoji"><span data-icon="smiley" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path opacity=".45" fill="#263238" d="M9.153 11.603c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962zm-3.204 1.362c-.026-.307-.131 5.218 6.063 5.551 6.066-.25 6.066-5.551 6.066-5.551-6.078 1.416-12.129 0-12.129 0zm11.363 1.108s-.669 1.959-5.051 1.959c-3.505 0-5.388-1.164-5.607-1.959 0 0 5.912 1.055 10.658 0zM11.804 1.011C5.609 1.011.978 6.033.978 12.228s4.826 10.761 11.021 10.761S23.02 18.423 23.02 12.228c.001-6.195-5.021-11.217-11.216-11.217zM12 21.354c-5.273 0-9.381-3.886-9.381-9.159s3.942-9.548 9.215-9.548 9.548 4.275 9.548 9.548c-.001 5.272-4.109 9.159-9.382 9.159zm3.108-9.751c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962z"></path></svg></span></button>
			<form action="#" id="enviarM" method="POST">
				<input id="topo_input_form" type="text" placeholder="Digite uma mensagem" name="mensagem">
				<button type="submit"  id="enviar" class="compose-btn-send"><span data-icon="send" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".45" d="M1.101 21.757L23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z"></path></svg></span></button>
			</form>
		</content>
	</div>
	<script type="text/javascript" >
        function requisitar(){
            var xmlhttp;
            if (window.XMLHttpRequest)
            {
                 xmlhttp=new XMLHttpRequest();
            }
            else 
            {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    document.getElementById("centro").innerHTML=xmlhttp.responseText;
                    var p = document.getElementById('centro');
           			p.scrollTop = 9999;
                }
            }
            xmlhttp.open("GET","scripts/chat.php",true);
            xmlhttp.send();
        }
		window.setInterval(requisitar, 1500);
	</script>
</body>
</html>