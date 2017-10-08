<?php
	require_once('../class/com.sistema.php');
	$log = new logout;
	$log -> newToken($_SESSION['token']);
	$_SESSION['token'] = "";
	session_destroy();
	header("Location: ../");
?>