<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$thread = isset($_POST["thread_id"]) ? $_POST["thread_id"] : false;
	$reply = isset($_POST["reply"]) ? $_POST["reply"] : false;

	if (!$thread) {
		$_SESSION['error'] = "Please select a valid thread.";
		header("Location:/forum/");
		die();
	}

	if (!$reply) {
		$_SESSION['error'] = "Reply not defined.";
		header("Location:/thread/?thread=" . $thread);
		die();
	}

	if (!$user_is_admin) {
		$stmt = $dbh->prepare("SELECT uc FROM StudentUCs WHERE student=? AND uc=?;");
		$stmt->execute([$user_id, $uc]);

		if (!$stmt->fetch()) {
			$_SESSION['error'] = "You don't have permissions to access this thread.";
			header("Location:/forum/");
			die();
		}
	}
	
	$stmt = $dbh->prepare("INSERT INTO Reply (creation_date, content, author, thread) VALUES (?, ?, ?, ?)");
	$stmt->execute([time(), $reply, $user_id, $thread]);
	$_SESSION['success'] = "Reply posted with success.";
	header("Location:/thread/?thread=" . $thread);
	die();
?>
