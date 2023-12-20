<?php
	session_start();
	$user = $_SESSION["user_id"];
	$new_password = $_GET['new_password'];
	$password = $_GET['password'];
	$confirm = $_GET['confirm'];
	var_dump($_GET);

	if ($confirm != $new_password) {
		$_SESSION['error'] = "The passwords don't match";
		header('Location:/user_settings/change_password/');
		die();
	}

	if (strlen($new_password) < 8) {
		$_SESSION['error'] = "The password should have at least 8 characters.";
		header('Location:/user_settings/change_password/');
		die();
	} else if (strlen($new_password) > 72) {
		$_SESSION['error'] = "BCrypt (hashing algorithm in use), can't hash passwords longer than 72 bytes.";
		header('Location:/user_settings/change_password/');
		die();
	}

    $dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');


	$sq = $dbh->prepare('SELECT password_hash FROM Student WHERE id=?;');
	$sq->execute([$user]);
	$user_data = $sq->fetch();


	$is_correct = password_verify($password, $user_data['password_hash']);
	if (!$is_correct) {
		$_SESSION['error'] = "Incorrect password";
		header('Location:/user_settings/change_password/');
		die();
	}

	$pw_hash = password_hash($new_password, PASSWORD_DEFAULT);
	$sq = $dbh->prepare('UPDATE Student SET password_hash=? WHERE id=?;');
	$sq->execute([$pw_hash, $user]);
	$user_exists = $sq->fetch();


    $_SESSION['success'] = "Password changed sucessfully";
	header('Location:/user_settings/change_password/');
	die();
?>