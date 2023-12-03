<?php 
	$title = "Register";
	$css = "login";
	include('../_partials/head.php'); 
?>
<body class="dark">
	<main>
		<div style="background-color:orange;width:300px;height:300px"></div>
		<form action="/actions/register/" method="POST" >
			<h2>Register</h2>
<?php if (isset($msg)) { ?>
			<span><?php echo $msg ?></span>
<?php } ?>
			<div class="parameter">
				<p><label for="email">Email</label></p>
				<p><input type="email" name="user_email" placeholder="johnsmith@domain.xyz" required="required" ></p>
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
