<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$thread = isset($_POST["thread_id"]) ? $_POST["thread_id"] : false;

	if (!$thread) {
		$_SESSION['error'] = "Please select a valid thread.";
		header("Location:/forum/");
		die();
	}

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');
	if (!$user_is_admin) {
		$stmt = $dbh->prepare("SELECT uc FROM StudentUCs WHERE student=? AND uc=?;");
		$stmt->execute([$user, $uc]);

		if (!$stmt->fetch()) {
			$_SESSION['error'] = "You don't have permissions to access this thread.";
			header("Location:/forum/");
			die();
		}
	}
	
	$stmt = $dbh->prepare("INSERT INTO Reply (creation_date, content, author, thread) VALUES (unixepoch(), ?, ?, ?)");
	$stmt->execute([$reply, $user_id, $thread]);
	$_SESSION['success'] = "Reply posted with success.";
	header("Location:/thread/?thread=" . $thread);
	die();
?>
