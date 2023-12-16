<?php
	session_start();
	$username = $_POST['username'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];

	if ($confirm != $password) {
		$_SESSION['error'] = "The passwords don't match";
		header('Location:/register/');
		die();
	}

	if (strlen($password) < 8) {
		$_SESSION['error'] = "The password should have at least 8 characters.";
		header('Location:/register/');
		die();
	} else if (strlen($password) > 72) {
		$_SESSION['error'] = "BCrypt (hashing algorithm in use), can't hash passwords longer than 72 bytes.";
		header('Location:/register/');
		die();
	}

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');

	$sq = $dbh->prepare('SELECT * FROM Student WHERE username=?;');
	$sq->execute([$username]);
	$user_exists = $sq->fetch();
	if ($user_exists) {
		$_SESSION['error'] = "Username already in use.";
		header('Location:/register/');
		die();
	}

	$pw_hash = password_hash($password, PASSWORD_DEFAULT);
	$iq = $dbh->prepare('INSERT INTO Student (name, username, password_hash, creation_date)
	 	VALUES (?, ?, ?, ?)');
	$res = $iq->execute([$name, $username, $pw_hash, time()]);
	if (!$res) {
		$_SESSION['error'] = "Failed to add user. Please try again. If the problem persists, contact the support.";
		header('Location:/register/');
		die();
	}
	$_SESSION['success'] = "The registration was done sucessfully";
	header('Location:/');
	die();
?>
