<?php
	session_start();
	$user = $_SESSION["user_id"];
	$name = $_POST['new_name'];
	$password = $_POST['password'];

    $dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');


	$sq = $dbh->prepare('SELECT password_hash FROM Student WHERE id=?;');
	$sq->execute([$user]);
	$user_data = $sq->fetch();


	$is_correct = password_verify($password, $user_data['password_hash']);
	if (!$is_correct) {
		$_SESSION['error'] = "Incorrect password";
		header('Location:/user_settings/change_name/');
		die();
	}

    
	$sq = $dbh->prepare('UPDATE Student SET name=? WHERE id=?;');
	$sq->execute([$name, $user]);
	$user_exists = $sq->fetch();


    $_SESSION['success'] = "Name changed sucessfully";
	header('Location:/user_settings/change_name/');
	die();
?>