<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$question = isset($_GET["q"]) ? $_GET["q"] : false;
	$value = isset($_GET["v"]) ? $_GET["v"] : false;

	if (!$question) {
		$_SESSION['error'] = "Question to set rating not defined.";
		header("Location:" . $_SERVER['HTTP_REFERER']);
		die();
	}

	// Second condition needed since "0" is seen as false
	if (!$value && $value !== "0") {
		$_SESSION['error'] = "Value to set the rating not defined.";
		header("Location:" . $_SERVER['HTTP_REFERER']);
		die();
	}

	if (!(in_array($value, ["-1", "0", "1"]))) {
		$_SESSION['error'] = "Invalid rating value.";
		header("Location:" . $_SERVER['HTTP_REFERER']);
		die();
	}
	// Needs to be done afterwards since intval returns 0 on fail
	$value = intval($value);

	$stmt = $dbh->prepare("SELECT id FROM QuestionAttempts WHERE student=? AND question=?;");
	$stmt->execute([$user_id, $question]);
	if (!$stmt->fetch()) {
		$_SESSION['error'] = "You can't rate questions you haven't tried.";
		header("Location:" . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	$stmt = $dbh->prepare("INSERT INTO QuestionRating (student, question, user_score) 
		VALUES (?, ?, ?) ON CONFLICT(student, question) DO UPDATE SET user_score=?");
	$stmt->execute([$user_id, $question, $value, $value]);
	$_SESSION['success'] = "Rating set with success.";
	header("Location:" . $_SERVER['HTTP_REFERER']);
	die();
?>
