<?php
	$email = $_POST['user_email'];
	$pass = $_POST['password'];
	$confirm = $_POST['confirm'];

	# checks if both passwords are equal
	if ($confirm != $pass) {
		# TODO(Inserting user in the database)
		# TODO(Pass error message)
		header('Location:/register/');
	} else {
		# TODO(Pass succesful message)
		header('Location:/')
	}
?>
