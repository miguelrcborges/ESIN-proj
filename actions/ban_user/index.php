<?php
	session_start();

	$username = $_POST['username'];

	$dbh = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/db');


	$sqlDelete = $dbh->prepare('DELETE FROM Student WHERE username = ?');
	$sqlDelete->execute([$username]);
	$rowsAffected = $sqlDelete->rowCount();



	if ($rowsAffected > 0) {
		$_SESSION['success'] = 'User with username '.$username.' deleted successfully.';
	} else {
		$_SESSION['error'] = 'No user found with username "'.$username.'".';
	}

	header('Location:/admin_panel/user_lookup');
	die();
?>
