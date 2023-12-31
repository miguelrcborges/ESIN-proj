<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT']."/_partials/must_login.php");

	$uc = isset($_POST["uc"]) ? $_POST["uc"] : false;

	if (!$uc) {
		$_SESSION['error'] = "Please select a valid curricular unit.";
		header("Location:/select_uc/");
		die();
	}

	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');
	$stmt = $dbh->prepare("SELECT uc FROM StudentUCs WHERE student=? AND uc=?;");
	$stmt->execute([$user_id, $uc]);

	if (!$stmt->fetchAll()) {
		$_SESSION['error'] = "You can't submit questions to a curricular unit that you aren't signed up.";
		header("Location:/select_uc/");
		die();
	}

	$question = $_POST['question'];
	$option1 = $_POST['option1'];
	$option2 = $_POST['option2'];
	$option3 = $_POST['option3'];
	$option4 = $_POST['option4'];

	if ($option3 == NULL) {
		$option3 = NULL;
		$option4 = NULL;
	}
	elseif ($option4 == NULL) {
		$option4 = NULL;
	}

	if (
	$option1 == $option2 ||
		$option1 == $option2 ||
		$option1 == $option3
	) {
		$_SESSION['error'] = "The correct option is equal to one of the wrong ones.";
		header("Location:" . $_SERVER["HTTP_REFERER"]);
		die();
	}

	$sq = $dbh->prepare("INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) 
		VALUES ( ?, ?, ?, ?, ?, ?, ?);");
	$sq->execute([$question, $option1, $option2, $option3, $option4, $user_id, $uc]);


	$_SESSION['success'] = "Question registered sucessfully.";
	header("Location:/solve_exercise/?uc_id=" . $uc );
	die()
?>
