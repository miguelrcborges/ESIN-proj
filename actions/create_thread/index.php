<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$THREAD_TITLE_LIMIT = 70;
	
	$title = $_POST["title"];
	$content = $_POST["content"];
	$filter = $_POST["filter"];
	if ($filter == "") {
		$filter = null; // So it sets null in the db
	}

	if (strlen($title) > $THREAD_TITLE_LIMIT) {
		$_SESSION['error'] = "You can't create threads with a title longer than " . $THREAD_TITLE_LIMIT . " characters.";
		header("Location:/create_thread/");
		die();
	}

	if ($filter) {
		$stmt = $dbh->prepare("SELECT uc FROM StudentUCs WHERE student=? and uc=?;");
		$stmt->execute([$_SESSION['user_id'], $filter]);
		$isinuc = $stmt->fetchAll();
		
		if (!$isinuc) {
			$_SESSION['error'] = "You can't post threads on courses you aren't signed in";
			header("Location:/create_thread/");
			die();
		}
	}

	$stmt = $dbh->prepare("INSERT INTO Thread (title, creation_date, content, author, uc) VALUES (?, ?, ?, ?, ?);");
	$stmt->execute([$title, time(), $content, $user_id, $filter]);
	$_SESSION['success'] = "Thread was created successfully";
	header("Location:/forum/");
	die();
?>
