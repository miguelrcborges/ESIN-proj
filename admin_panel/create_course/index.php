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
        <h2>Create Course</h2>
        
        <form id= "create" action="/actions/create_course/" type="GET">
            <input type="text" name="c_name" placeholder="course name" required="required">
            <button>Create</button>
        </form>

		<?php
		if (isset($_GET['course'])) {
			$c_name = $_GET["course"];
			include_once("display_course.php");
		} ?>

		<?php if ($success) { ?>
			<p class="success"><?php echo $success; ?></p>
		<?php }
		if ($error) { ?>
			<p class="error"><?php echo $error; ?></p>
		<?php } ?>

    </main>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>
