<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/must_login.php'); 

	$title = "User Settings";
	$css = ["user_settings", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");


	$user_id = $_SESSION["user_id"];
	
	$sql = $dbh->prepare("
	SELECT
		s.name,
		s.username,
		s.creation_date,
		r.name AS role_name,
		c.name AS course_name
	FROM
		Student s
		JOIN Role r ON s.role_id = r.id
		JOIN Course c ON s.course_id = c.id
	WHERE
		s.id = ?
");

	$sql->execute([$user_id]);
	$user_info = $sql->fetch();
?>

<h1>User Settings</h1>
<section>
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/sidebar.php"); ?>
	<main>
		<h2>Change Name</h2>
		<form action='\actions\user_settings\change_name' method='POST'>
			<p><strong>Current Name: </strong><?php echo $user_info["name"]?></p>
			<label for new_name><strong>New Name:</strong></label>
			<input type="text" name="new_name" placeholder="BabyGronk" required="required">
			<label for="password"><strong>Password:</strong></label>
			<input type="password" name="password" placeholder="snakegoodfriend420" required="required">
			<button type="submit">Confirm</button>
		</form>
	</main>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>

