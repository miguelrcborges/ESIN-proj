<?php
	session_start();
	$_SESSION['theme'] = "light";
	header('Location:/forum/');
	die();
?>
