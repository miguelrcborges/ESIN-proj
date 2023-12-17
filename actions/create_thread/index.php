<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT']."/_partials/must_login.php");
	
	$title = $_POST["title"];
	$content = $_POST["content"];
	$filter = $_POST["filter"];
	if ($filter == "") {
		$filter = null; // So it sets null in the db
	}

	if ($filter) {
		$stmt = $dbh->prepare("SELECT uc FROM StudentUCs WHERE student=? and uc=?;");
		$stmt->execute([$_SESSION['user_id'], $filter]);
		$isinuc = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (!$isinuc) {
			$_SESSION['error'] = "You can't post threads on courses you aren't signed in";
			header("Location:/create_thread/");
			die();
		}
	}

	$stmt = $dbh->prepare("INSERT INTO Thread (title, creation_date, content, author, uc) VALUES (?, unixepoch(), ?, ?, ?);");
	$stmt->execute([$title, $content, $user_id, $filter]);
	$_SESSION['success'] = "Thread was created successfully";
	header("Location:/forum/");
	die();
?>
