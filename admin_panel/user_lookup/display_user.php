	<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$sql = $dbh->prepare('
		SELECT 
		s.name, 
		s.id, 
		s.creation_date, 
		r.name AS role_name, 
		c.name AS course_name
		FROM 
		Student s
		JOIN 
		Course c ON s.course_id = c.id
		OR s.course_id IS NULL
		JOIN 
		Role r ON s.role_id = r.id 
		WHERE 
		s.username = ?
		');

	$sql->execute([$username]);
	$user_stats = $sql->fetch();

	if (empty($user_stats)) {
		echo('<p>No user named "' . $username . '"</p>');
		die();
	}

	$pfp_loc = $_SERVER['DOCUMENT_ROOT'].'/assets/pfp/cat'.($user_stats[1]%10) . '.jpg';
?>


<img src=<?php echo($pfp_loc);?> alt='Profile Picture' style='width:300px;height:300px;'>

<div>
	<p><strong>Name:</strong>                       <?php echo $user_stats[0]?> </p>
	<p><strong>Username:</strong>                   <?php echo $username?> </p>
	<p><strong>Course:</strong>                     <?php echo $user_stats[4]?> </p>
	<p><strong>Account Role:</strong>               <?php echo $user_stats[3]?> </p>
	<p><strong>Account Created on:</strong>         <?php echo date('d-m-Y', strtotime($user_stats[3])) ?> </p>
</div>

<form action='\actions\ban_user' method='POST'>
	<input type='hidden' name='username' value='<?php echo($username); ?>'>
	<button>Ban User</button>
</form>