<!DOCTYPE HTML>
<html lang="en">
	<?php 
		$title = "Register";
		$css = "login";
		include('../_partials/head.php'); 
	?>
	<body class="dark">
		<main>
			<div style="background-color:orange;width:300px;height:300px"></div>
			<form action ="/process.php" method ="post" >
				<h2>Register</h2>
				<p><label for="email">Email</label></p>
				<p><input type="email" name="user_email" required="required" ></p>
				<p><label for="password">Password</label></p>
				<p><input type="password" name="password" required="required"></p>
        <p><label for="confirm">Confirm Password</label></p>
				<p><input type="password" name="confirm" required="required"></p>
				<button type="submit">Register</button>
			</div>
		</main>
	</body>
</html>

