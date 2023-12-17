<?php
	session_start();
	$user = $_SESSION["user_id"];
	$username = $_POST['new_name'];
	$password = $_POST['password'];

    $dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');


	$sq = $dbh->prepare('SELECT password_hash FROM Student WHERE id=?;');
	$sq->execute([$user]);
	$user_data = $sq->fetch();


	$is_correct = password_verify($password, $user_data['password_hash']);
	if (!$is_correct) {
		$_SESSION['error'] = "Incorrect password";
		header('Location:/user_settings/change_username/');
		die();
	}

	$sq = $dbh->prepare('SELECT * FROM Student WHERE username=?;');
	$sq->execute([$username]);
	$user_exists = $sq->fetch();

	if ($user_exists) {
		$_SESSION['error'] = "Username already in use.";
		header('Location:/user_settings/change_username/');
		die();
	}

    
	$sq = $dbh->prepare('UPDATE Student SET username=? WHERE id=?;');
	$sq->execute([$username, $user]);
	$user_exists = $sq->fetch();


    $_SESSION['success'] = "Username changed sucessfully";
	header('Location:/user_settings/change_username/');
	die();
?>