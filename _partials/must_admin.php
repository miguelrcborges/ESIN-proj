<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_partials/must_login.php");

	if (!$user_is_admin) {
		$_SESSION['error'] = "Only admin-level users can see the following page";
		header('Location:/');
		die();
	}
?>
