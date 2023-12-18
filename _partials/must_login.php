<?php
	if (!isset($_SESSION['user_id'])) {
		$_SESSION['error'] = "Only registered users can see the following page.";
		header('Location:/');
		die();
	}
	
	$user_id = $_SESSION['user_id'];

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$sq = $dbh->prepare('SELECT role_id FROM Student WHERE id=?;');
	$sq->execute([$user_id]);
	$user_exists = $sq->fetch();
	if (!$user_exists) {
		session_destroy();
		session_start();
		$_SESSION['error'] = "Deleted invalid session.";
		header('Location:/');
		die();
	}

	$user_is_admin = $user_exists['role_id'] == 2;
?>
