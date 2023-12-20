<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT']."/_partials/must_admin.php");
	
	$course = isset($_POST["course"]) ? $_POST["course"] : false;
	$name = isset($_POST["name"]) ? $_POST["name"] : false;
	$code = isset($_POST["code"]) ? $_POST["code"] : false;
	
	if (!$course) {
		$_SESSION['error'] = "Course was not set.";
		header("Location:/admin_panel/manage_ucs/");
		die();
	}

	if (!$name) {
		$_SESSION['error'] = "UC name was not set.";
		header("Location:/admin_panel/manage_ucs/");
		die();
	}

	if (!$code) {
		$_SESSION['error'] = "UC code was not set.";
		header("Location:/admin_panel/manage_ucs/");
		die();
	}
	
	
	$stmt = $dbh->prepare("SELECT id FROM Course");
	$stmt->execute();
	$valid_course = false;
	var_dump($stmt->fetchAll());
	die();
	foreach ($stmt->fetchAll() as $row) {
		if ($valid_course) {}
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
