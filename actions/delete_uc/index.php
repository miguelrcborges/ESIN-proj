<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT']."/_partials/must_admin.php");
	
	$uc = isset($_GET["uc"]) ? $_GET["uc"] : false;
	
	if (!$uc) {
		$_SESSION['error'] = "UC was not set.";
		header("Location:/admin_panel/manage_ucs/");
		die();
	}
	
	
	$stmt = $dbh->prepare("SELECT course FROM UC WHERE id = ?");
	$stmt->execute([$uc]);
	$course = $stmt->fetch();
	if (!$course) {
		$_SESSION['error'] = "UC does not exist.";
		header("Location:/admin_panel/manage_ucs/");
		die();
	}

	$stmt = $dbh->prepare("DELETE FROM UC WHERE id = ?");
	$stmt->execute([$uc]);
	$_SESSION['success'] = "UC was deleted successfully";
	header("Location:/admin_panel/manage_ucs/?course=" . $course['course']);
	die();
?>
