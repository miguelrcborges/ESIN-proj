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
		<form action="/admin_panel/question_lookup" type="GET">
			<input type="number" name="q_id" placeholder="Question ID" required="required">
			<button>Search</button>
		</form>

		<div>
			<?php
			if (isset($_GET['q_id'])) {
				$q_id = $_GET["q_id"];
				include_once("display_question.php");
			}?>
		</div>
	</main>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>
