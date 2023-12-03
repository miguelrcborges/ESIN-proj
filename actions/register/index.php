<?php
	session_start();
	$email = $_POST['user_email'];
	$pass = $_POST['password'];
	$confirm = $_POST['confirm'];

	if ($confirm != $pass) {
		$_SESSION['msg'] = "The passwords don't match";
		header('Location:/register/');
		die();
	}
	
	# TODO(Inserting user in the database && other needed checks)
	$_SESSION['msg'] = "The registration was done sucessfully";
	header('Location:/');
	die();
?>
