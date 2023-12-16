<?php
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . 'db');
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$sq = $dbh->prepare('SELECT * FROM Student WHERE username=?;');
	$sq->execute([$username]);
	$user_exists = $sq->fetch();
	if (!$user_exists) {
		$_SESSION['msg'] = "User not found";
		header('Location:/login/');
		die();
	}

	$is_correct = password_verify($password, $user_exists['password_hash']);
	if (!$is_correct) {
		$_SESSION['msg'] = "Incorrect password";
		header('Location:/login/');
		die();
	}

	$_SESSION['user_id'] = $user_exists['id'];
	header('Location:/');
	die();
?>
