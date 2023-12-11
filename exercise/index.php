<?php 
	include_once("../_partials/must_login.php");

	$title = "Login";
	$css = ["index", "header"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");
	session_start();
?>
<main>
	<h1><? var_dump($_SESSION); ?></h1>
</main>