<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/_partials/redirect_logged.php");

	$css = ["index", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");

	if (isset($_SESSION['user_id'])) {
		echo '<body class="dark"><a href="/actions/logout">Logout</a></body>';
		die();
	}
?>
<body>
	<main>
		<img src="/assets/webjonas.png">
<?php if (isset($error)) { ?>
		<span class="error"><?php echo $error ?></span>
<?php } ?>
<?php if (isset($success)) { ?>
		<span class="success"><?php echo $success ?></span>
<?php } ?>
		<div>
			<a href="/register/"><button class="secondary">Register</button></a>
			<a href="/login/"><button>Login</button></a>
		</div>
	</main>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php");
?>
