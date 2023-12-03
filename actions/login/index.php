<?php
	session_start();
	$email = $_POST['user_email'];
	$pass = $_POST['password'];

	# TODO(Write the actual code)
	$_SESSION['msg'] = "User not found";
	header('Location:/login/');
	die();
?>
