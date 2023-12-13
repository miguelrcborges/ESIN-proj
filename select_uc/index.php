<?php 
	session_start();

	include_once("../_partials/must_login.php");

	$title = "Exercises";
	$css = ["header", "footer", "select_uc"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");

	$dbh = new PDO('sqlite:../db');
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$stmt = $dbh->prepare("SELECT id,name FROM StudentUCs JOIN UC ON id=uc WHERE student=?");
	$stmt->execute(array($_SESSION['user_id']));
	$ucs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
	<main>
		<h1 class="title">Choose what you will study today!</h1>
		<?php if (isset($msg)) { ?>
		<div class="message"><?php echo $msg ?></div>
		<?php } ?>
		<form action="/solve_exercise/" method='GET'>
			<select name="uc_id">
				<?php foreach($ucs as $uc){
					echo '<option value="' . $uc['id'] . '" name="uc">' . $uc['name'] . '</option>';
				} ?>
			</select>
			<button type="submit">Study</button>
		</form>
	</main>
</body>

<?php
	include_once("../_partials/footer.php");
?>
