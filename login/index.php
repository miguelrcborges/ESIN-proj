<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/_partials/redirect_logged.php");

	$title = "Login";
	$css = ["login"];
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
?>
<body>
	<main>
		<a href="/"><img src="/assets/logo.png"></a>
		<form action="/actions/login/" method="POST">
			<h2>Login</h2>
<?php if (isset($msg)) { ?>
			<span><?php echo $msg ?></span>
<?php } ?>
			<div class="parameter">
				<p><label for="username">Username</label></p>
				<p><input type="text" name="username" placeholder="jsmith" required="required"></p>
			</div>
			<div class="parameter">
				<p><label for="password">Password</label></p>
				<p><input type="password" name="password" placeholder="snakegoodfriend420" required="required"></p>
			</div>
			<button type="submit">Login</button>
			<p>Not registered yet? <a href="/register/">Register here</a></p>
		</div>
	</main>
</body>
