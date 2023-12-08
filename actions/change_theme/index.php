<?php
	session_start();
	header("Location:" . $_SERVER["HTTP_REFERER"]);
	if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'light') {
		$_SESSION['theme'] = "dark";
	} else {
		$_SESSION['theme'] = "light";
	}
	die();
?>
