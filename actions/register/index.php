<?php
	$email = $_POST['user_email'];
	$pass = $_POST['password'];
	$confirm = $_POST['confirm'];
	if ($confirm != $pass) {
		header('Location:/register/index.html')
	}
?>
