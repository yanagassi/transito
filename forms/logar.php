<?php

if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
	require_once("../class/com.sistema.php");
	$Login = new Login;
	$Login->logar($_POST['usuario'], $_POST['senha']);
	header('Location: ../');	
}
else{
	header('Location: ../');
}
?>