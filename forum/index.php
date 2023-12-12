<?php 
	session_start();
	include_once("../_partials/must_login.php");

	$title = "Login";
	$css = ["forum", "header", "footer"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");
?>
<main>
	<header>
		<button>Add a Post</button>
		<search>
			<form action="/forum/" type="POST">
				<strong>Filters</strong>
				<div>
					<label for="uc">UC:</label>	
					<select name="uc">
						<option value="mnes">MNES</option>
						<option value="ah">AH</option>
					</select>
				</div>
				<button type="submit">Filter</button>
			</form>
		</search>
	</header>
</main>

<?php include_once("../_partials/footer.php"); ?>
