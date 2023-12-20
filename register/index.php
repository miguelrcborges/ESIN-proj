<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/_partials/redirect_logged.php");

	$title = "Register";
	$css = ["login"];
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
?>
<body>
	<main>
		<a href="/"><img src="/assets/logo.png"></a>
		<form action="/actions/register/" method="POST" >
			<h2>Register</h2>
<?php if (isset($error)) { ?>
			<span class="error"><?php echo $error?></span>
<?php } ?>
			<div class="parameter">
				<p><label for="name">Name</label></p>
				<p><input type="text" id="name" name="name" placeholder="Jon Smith" required="required"></p>
			</div>
			<div class="parameter">
				<p><label for="username">Username</label></p>
				<p><input type="text" id="username" name="username" placeholder="jsmith" required="required"></p>
			</div>
			<div class="parameter">
				<p><label for="password">Password</label></p>
				<p><input type="password" id="password" name="password" placeholder="snakegoodfriend420" required="required"></p>
			</div>
			<div class="parameter">
				<p><label for="confirm">Confirm Password</label></p>
				<p><input type="password" id="confirm" name="confirm" placeholder="snakegoodfriend420" required="required"></p>
			</div>
			<button type="submit">Register</button>
			<p>Already registered? <a href="/login/">Log in</a></p>
	</main>
</body>
