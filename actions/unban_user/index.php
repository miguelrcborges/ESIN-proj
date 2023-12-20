<?php
	session_start();

	$username = $_GET['username'];
	$current_role = $_GET['role'];

	if($current_role != 3)
	{
		$_SESSION['error'] = 'User "'.$username.'" is not banned.';
		header('Location:/admin_panel/user_lookup/');
		die();
	}

	$dbh = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/db');


	$sqlDelete = $dbh->prepare('UPDATE Student SET role_id = 1 WHERE username = ?');
	$sqlDelete->execute([$username]);
	$rowsAffected = $sqlDelete->rowCount();



	if ($rowsAffected > 0) {
		$_SESSION['success'] = 'User with username '.$username.' successfully unbanned.';
	} else {
		$_SESSION['error'] = 'No user found with username "'.$username.'".';
	}

	header('Location:/admin_panel/user_lookup/');
	die();
?>
