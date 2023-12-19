<?php
	session_start();
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$answer = $_POST['answer'];
	$question_id = $_POST['qid'];
	$uc = $_POST['uc'];

	if (!$user_id) {
		$_SESSION['error'] = "You must login to be able to do exercises";
		header("Location:/");
		die();
	}

	$map = ['correct_answer' => 1, 'wrong_answer1' => 2, 'wrong_answer2' => 3, 'wrong_answer3' => 4];
	$selected = isset($map[$answer]) ? $map[$answer] : false;
	if (!$selected) {
		$_SESSION['error'] = "Please don't cheat! :c";
		header("Location:/select_uc/");
		die();
	}

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');
	$stmt = $dbh->prepare("SELECT uc FROM StudentUCs WHERE student=? AND UC=?");
	$stmt->execute([$user_id, $uc]);

	if (!$stmt->fetchAll()) {
		$_SESSION['error'] = "You can't solve exercises for courses that you aren't signed up";
		header("Location:/select_uc/");
		die();
	}

	$stmt = $dbh->prepare("INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (?, ?, ?, ?);");
	$stmt->execute([$user_id, $question_id, time(), $selected]);
	
	header("Location:/attempt/?a=" . $dbh->lastInsertId());
	die();
?>
