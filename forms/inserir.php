<?php
	
	if (!empty($_POST['mensagem'])) {
		require_once("../class/com.sistema.php");
		$chat = new chat;
		$chat -> insert($_POST['mensagem']);
		header("Location: ../");
	}

?>