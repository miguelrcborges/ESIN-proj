<!DOCTYPE HTML>
<html lang="en">
	<?php 
		$title = "Login";
		$css = "login";
		include('../_partials/head.php'); 
	?>
	<body class="dark">
		<main>
			<div style="background-color:orange;width:300px;height:300px"></div>
			<form>
				<h2>Login</h2>
				<div class="parameter">
					<p><label for="email">Email</label></p>
					<p><input type="email" placeholder="myepicemail@cloud.xyz"></p>
				</div>
				<div class="parameter">
					<p><label for="password">Password</label></p>
					<p><input type="password" placeholder="iliketurtles420"></p>
				</div>
				<button type="submit">Login</button>
				<p>Not registered yet? <a href="/register/">Register here</a></p>
			</div>
		</main>
	</body>
</html>
