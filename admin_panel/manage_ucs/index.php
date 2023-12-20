<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$scourse = isset($_GET['course']) ? $_GET['course'] : false;

	$title = "Admin Panel";
	$css = ["admin_panel", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");

	$sq = $dbh->prepare("SELECT * FROM Course;");
	$sq->execute([]);
	$courses = $sq->fetchAll();
	$is_course_selected = false;
?>

<h1>Admin Panel </h1>
<section>
	<?php include_once("../_partials/sidebar.php");?>
	<main>
		<h2>Manage Courses</h2>

		<form action="/admin_panel/manage_ucs/" method="GET">
			<label for="course">Select a course to manage.</label>
			<select id="course" name="course">
				<option>None</option>
				<?php foreach ($courses as $course) {
					if ($course['id'] == $scourse) {
						echo '<option value="' . $course['id'] . '" selected>' . $course['name'] . '</option>';
						$is_course_selected = true;
					}
					else {
						echo '<option value="' . $course['id'] . '">' . $course['name'] . '</option>';
					}
				} ?>
			</select>
			<button type="submit">Select</button>
		</form>
		<?php if ($success) { ?>
			<p class="success"><?php echo $success; ?></p>
		<?php }
			if ($error) { ?>
				<p class="error"><?php echo $error; ?></p>
		<?php } ?>

<?php if ($is_course_selected) { ?>
		<form action="/actions/create_uc/" method="POST">
			<h2>Create UC</h2>
			<input type="hidden" name="course" value="<?php echo $scourse;?>">
			<div class="parameter">
				<p><label for="name">UC name</label></p>
				<p><input type="text" id="name" name="name" placeholder="Jon Smith" required="required"></p>
			</div>
			<div class="parameter">
				<p><label for="code">UC code</label></p>
				<p><input type="text" id="code" name="code" placeholder="jsmith" required="required"></p>
			</div>
			<button type="submit">Create</button>
		</form>

		<form>
			<h2>Delete UC</h2>
			<div class="ucs-container">
				<?php 
					$sq = $dbh->prepare("SELECT id, name FROM UC WHERE course = ?;");
					$sq->execute([$scourse]);
					$ucs = $sq->fetchAll();
					
					foreach ($ucs as $uc) {
						$name = $uc['name'];
						$id = $uc['id'];
						echo "<a href='/actions/delete_uc/?uc=$id'><p>$name</p></a>";
					}
				?>
			</div>
		</form>
<?php } ?>
	</main>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>
