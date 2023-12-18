<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/must_login.php'); 

	$title = "User Settings";
	$css = ["user_settings", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");
?>

<h1>User Settings</h1>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/sidebar.php"); ?>
<main>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>

