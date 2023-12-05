<?php 
	include("_partials/redirect_logged.php");

	$css = ["index"];
	include_once("_partials/head.php");
?>
<body class="dark">
	<main>
		<img src="/assets/webjonas.png">
<?php if (isset($msg)) { ?>
		<span><?php echo $msg ?></span>
<?php } ?>
		<div>
			<a href="/register/"><button class="secondary">Register</button></a>
			<a href="/login/"><button>Login</button></a>
		</div>
	</main>
</body>
</html>
