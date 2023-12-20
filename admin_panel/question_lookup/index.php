<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$title = "Admin Panel";
	$css = ["admin_panel", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");
?>

<h1>Admin Panel </h1>

<section>
	<?php include_once("../_partials/sidebar.php") ?>
	<main>
		<h2>Manage Questions</h2>

		<form id= "search" action="/admin_panel/question_lookup/" type="GET">
			<input type="number" name="q_id" placeholder="question ID" required="required">
			<button>Search</button>
		</form>
		
		<?php if ($success) { ?>
			<p class="success"><?php echo $success; ?></p>
		<?php }
		if ($error) { ?>
			<p class="error"><?php echo $error; ?></p>
		<?php } ?>

		
		<?php
		if (isset($_GET['q_id'])) {
			$q_id = $_GET["q_id"];
			include_once("display_question.php");
		}?>
		
	</main>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>
