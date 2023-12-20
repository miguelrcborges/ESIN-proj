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
	if (!$stmt->fetchAll(PDO::FETCH_COLUMN)) {
		$_SESSION['error'] = "Invalid course selected.";
		header("Location:/admin_panel/manage_ucs/");
		die();
	}

	$stmt = $dbh->prepare("INSERT INTO UC (name, code, course) VALUES (?, ?, ?);");
	$stmt->execute([$name, $code, $course]);
	$_SESSION['success'] = "UC was created successfully";
	header("Location:/admin_panel/manage_ucs/?course=" . $course);
	die();
?>
