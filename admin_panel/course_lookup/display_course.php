	<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$sql = $dbh->prepare('
		SELECT
			c.id,
			COUNT(*) as n_students 
		FROM Course c
		LEFT JOIN
			Student s
				ON s.course_id=c.id
		WHERE
			c.name = ?
			AND s.role_id !=3;
		');

	$sql->execute([$c_name]);
	$course_stats = $sql->fetch();

	if (empty($course_stats['id'])) {
		echo('<p class="error">No course named "' . $c_name . '"</p></main></section></body>');
        include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); 
		die();
	}
?>

<div>

	<div>
		<p><strong>Name:</strong>                       <?php echo $c_name?> </p>
		<p><strong>Enrolled Students:</strong>          <?php echo $course_stats["n_students"]?> </p>
	</div>

	<form id="ban" action='/actions/delete_course/' method='GET'>
		<input type='hidden' name='c_name' value='<?php echo($c_name); ?>'>
		<input type='hidden' name='c_id' value='<?php echo($course_stats["id"]); ?>'>
		<button>Delete Course</button>
	</form>

</div>
