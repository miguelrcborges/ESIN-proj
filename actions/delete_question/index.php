<?php
	session_start();

	$q_id = $_POST['q_id'];

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');

	$sqlDelete = $dbh->prepare('DELETE FROM Question WHERE id = ?');
	$sqlDelete->execute([$q_id]);
	$rowsAffected = $sqlDelete->rowCount();

	if ($rowsAffected > 0) {
		$_SESSION['error'] = "Question #$q_id removed successfully";
	} else {
		$_SESSION['error'] = "Question #$q_id not found";
	}

	header($_SERVER['DOCUMENT_ROOT'] . '/admin_panel/question_lookup');
?>
