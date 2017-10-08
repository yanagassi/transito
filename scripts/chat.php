<?php require_once("../class/com.sistema.php"); $chat = new chat; $chat->chat();
	if (empty($_SESSION['token'])) {
		header("Location: ../");
	}
 ?>
