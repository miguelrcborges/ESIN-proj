<?php 
	include("../_partials/redirect_logged.php");

	$title = "Register";
	$css = ["login"];
	include('../_partials/head.php'); 
?>
<body>
	<main>
		<img src="/assets/logo.png">
		<form action="/actions/register/" method="POST" >
			<h2>Register</h2>
<?php if (isset($msg)) { ?>
			<span><?php echo $msg ?></span>
<?php } ?>
			<div class="parameter">
				<p><label for="name">Name</label></p>
				<p><input type="text" name="name" placeholder="Jon Smith" required="required"></p>
			</div>
			<div class="parameter">
				<p><label for="username">Username</label></p>
				<p><input type="text" name="username" placeholder="jsmith" required="required"></p>
			</div>
			<div class="parameter">
				<p><label for="password">Password</label></p>
				<p><input type="password" name="password" placeholder="snakegoodfriend420" required="required"></p>
					</div>
			<div class="parameter">
				<p><label for="confirm">Confirm Password</label></p>
				<p><input type="password" name="confirm" placeholder="snakegoodfriend420" required="required"></p>
			</div>
			<button type="submit">Register</button>
			<p>Already registered? <a href="/login/">Log in</a></p>
		</div>
	</main>
</body>
