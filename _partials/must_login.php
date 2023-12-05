<?php
	session_start();

	if (!isset($_SESSION['user_id'])) {
		$_SESSION['msg'] = "Only registered users can see the following page";
		header('Location:/');
		die();
	}
	
	$user_id = $_SESSION['user_id'];

	$dbh = new PDO('sqlite:../db');
	$sq = $dbh->prepare('SELECT role_id FROM Student WHERE id=?;');
	$sq->execute([$user_id]);
	$user_exists = $sq->fetch();
	if (!$user_exists) {
		session_destroy();
		session_start();
		$_SESSION['msg'] = "Deleted invalid session.";
		header('Location:/');
		die();
	}

	$user_is_admin = $user_exists['role_id'] == 2;
?>
