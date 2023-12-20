<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$title = "Admin Panel";
	$css = ["admin_panel", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");

	$stmt = $dbh->prepare("SELECT id, name FROM Course;");
	$stmt->execute(array());
	$courses = $stmt->fetchAll();
?>

<h1>Admin Panel </h1>

<section>
	<?php include_once("../_partials/sidebar.php") ?>
	<main>
        <h2>Remove Course</h2>
        
        <form id= "search" action="/admin_panel/course_lookup/" type="GET">
			<select name="course" required="required">
				<?php foreach ($courses as $course) {
					echo '<option value="' . $course['name'] . '">' . $course['name'] . '</option>';
				} ?>
			</select>
            <button>Search</button>
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
