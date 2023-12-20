<?php
	session_start();

	$username = $_POST['username'];
	$current_role = $_POST['role'];

	$dbh = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/db');

	if($current_role == 2)
	{
		$sql = $dbh->prepare('SELECT id FROM Student WHERE username = ?;');
		$sql->execute([$username]);
		$id = $sql->fetchColumn();

		if ($id == $_SESSION["user_id"]) {
			$_SESSION['error'] = "Can't ban yourself.";
		} else {
			$_SESSION['error'] = "Can't ban an admin level user.";
		}
		header('Location:/admin_panel/user_lookup');
		die();
	}
	elseif($current_role == 3)
	{
		$_SESSION['error'] = 'User "'.$username.'" is already banned.';
		header('Location:/admin_panel/user_lookup');
		die();
	}


	$sqlDelete = $dbh->prepare('UPDATE Student SET role_id = 3 WHERE username = ? AND role_id = 1;');
	$sqlDelete->execute([$username]);
	$rowsAffected = $sqlDelete->rowCount();



	if ($rowsAffected > 0) {
		$_SESSION['success'] = 'User with username '.$username.' banned successfully.';
	} else {
		$_SESSION['error'] = 'No user found with username "'.$username.'".';
	}

	header('Location:/admin_panel/user_lookup');
	die();
?>
