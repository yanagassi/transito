<?php

if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
	require_once("../class/com.sistema.php");
	$Login = new Login;
	$Login->logar($_POST['usuario'], $_POST['senha']);
	header('Location: ../index.php');	
}
else{
	print('erro: ' . mysql_error());
}
?>