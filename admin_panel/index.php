<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$title = "Admin Panel";
	$css = ["admin_panel", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");
?>

<h1>Admin Panel </h1>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/admin_panel/_partials/sidebar.php"); ?>
<main>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>
