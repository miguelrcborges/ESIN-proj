<?php
	session_start();

	$c_name = $_GET['c_name'];
	$c_id = $_GET['c_id'];

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');


	$sqlDelete = $dbh->prepare('DELETE FROM Course WHERE name = ?;');
	$sqlDelete->execute([$c_name]);
	$rowsAffected = $sqlDelete->rowCount();



	if ($rowsAffected > 0) {
		$_SESSION['success'] = "Course ".$c_name." removed successfully";
	} else {
		$_SESSION['error'] = "Course ".$c_name." not found";
		header('Location:/admin_panel/course_lookup/');
		die();
	}

	$sql = $dbh->prepare('UPDATE Student SET course_id = NULL WHERE course_id = ?;');
	$sql->execute([$c_id]);

	header('Location:/admin_panel/course_lookup/');
?>
