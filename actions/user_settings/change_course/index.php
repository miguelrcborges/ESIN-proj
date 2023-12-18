<?php
	session_start();
	$user = $_SESSION["user_id"];
	$course = $_POST['c_id'];
	$password = $_POST['password'];

    $dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');


	$sq = $dbh->prepare('SELECT course_id, password_hash FROM Student WHERE id=?;');
	$sq->execute([$user]);
	$user_data = $sq->fetch();

	if ($course == $user_data['course_id']) {
		$_SESSION['error'] = "Already enrolled in that course";
		header('Location:/user_settings/change_course/');
		die();
	}

	$is_correct = password_verify($password, $user_data['password_hash']);
	if (!$is_correct) {
		$_SESSION['error'] = "Incorrect password";
		header('Location:/user_settings/change_course/');
		die();
	}

    
	$sq = $dbh->prepare('UPDATE Student SET course_id=? WHERE id=?;');
	$sq->execute([$course, $user]);
	$user_exists = $sq->fetch();

	//TODO: Maybe should delete all StudentUC entries where this student appears, to reset UCs that aren't in the new course

    $_SESSION['success'] = "Course changed sucessfully";
	header('Location:/user_settings/change_course/');
	die();
?>