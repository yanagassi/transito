<?php
	require_once("class/com.sistema.php");
	$init = new init;
	session_start();
	if (!empty($_SESSION['token'])) {
		$confirma = $init->confirma($_SESSION['token']);
		if ($confirma) {
			include_once('view/inicial.php');
		}else{
			include_once('view/login.php');
		}
	}else{
		include_once('view/login.php');
	}
?>