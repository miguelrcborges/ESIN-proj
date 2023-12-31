<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$title = "Exercises";
	$css = ["header", "footer", "select_uc"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");


	$dbh = new PDO('sqlite:../db');

	$stmt = $dbh->prepare("SELECT id, name FROM StudentUCs JOIN UC ON id=uc WHERE student=?");
	$stmt->execute(array($_SESSION['user_id']));
	$ucs = $stmt->fetchAll();

	if (!$ucs) {
		$enrolled = "You are not enrolled in any UC! Please do so by enrolling <a href=\"/user_settings/\">here</a>!";
	}
?>

<main>
	<h1 class="title">Choose what you will study today!</h1>
	
	<?php if (isset($enrolled)) { ?>
		<div class="error"><?php echo $enrolled?></div> </form> </main> 
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); die();} ?>
	
	<?php if (isset($error)) { ?>
		<div class="error"><?php echo $error?></div>
	<?php } ?>

	<form action="/solve_exercise/" method='GET'>
		<select name="uc_id">
			<?php foreach ($ucs as $uc) {
				echo '<option value="' . $uc['id'] . '">' . $uc['name'] . '</option>';
			} ?>
		</select>
		<button type="submit">Study</button>
	</form>
</main>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php");
?>
