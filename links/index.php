<?php 
	include_once("../_partials/must_login.php");

	$title = "Login";
	$css = ["index", "header"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");
?>
	<main>
		<h2>Links</h2>
		<ul>
<?php if ($user_is_admin) { ?>
			<a href="/admin/"><li>Admin Panel</li></a>
<?php } ?>
			<a href="/forum/"><li>Forum</li></a>
			<a href="/exercises/"><li>Exercises</li></a>
			<a href='/actions/change_theme/'><li>
<?php if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'light') {
	echo "Dark Theme";
} else {
	echo "Light Theme";
}?>
			</li></a>
		</ul>
	</main>
</body>
</html>
