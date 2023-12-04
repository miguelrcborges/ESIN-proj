<?php
	session_start();
	$username = $_POST['username'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];

	if ($confirm != $password) {
		$_SESSION['msg'] = "The passwords don't match";
		header('Location:/register/');
		die();
	}

	if (strlen($password) < 8) {
		$_SESSION['msg'] = "The password should have at least 8 characters.";
		header('Location:/register/');
		die();
	} else if (strlen($password) > 72) {
		$_SESSION['msg'] = "BCrypt (hashing algorithm in use), can't hash passwords longer than 72 bytes.";
		header('Location:/register/');
		die();
	}
	

	$dbh = new PDO('sqlite:../../db');

	$sq = $dbh->prepare('SELECT * FROM Student WHERE username=? LIMIT 1;');
	$sq->execute([$username]);
	$user_exists = $sq->fetch();
	if ($user_exists) {
		$_SESSION['msg'] = "Username already in use.";
		header('Location:/register/');
		die();
	}

	$pw_hash = password_hash($password, PASSWORD_DEFAULT);
	$iq = $dbh->prepare('INSERT INTO Student (name, username, password_hash, creation_date)
	 	VALUES (?, ?, ?, ?)');
	$iq->execute([$name, $username, $pw_hash, time()]);
	$_SESSION['msg'] = "The registration was done sucessfully";
	header('Location:/');
	die();
?>
