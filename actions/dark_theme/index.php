<?php
	session_start();
	$_SESSION['theme'] = "dark";
	header('Location:/forum/');
	die();
?>
