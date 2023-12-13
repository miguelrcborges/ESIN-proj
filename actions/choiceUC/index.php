<?php
	session_start();
	$uc = $_POST['uc_id'];
	$dbh = new PDO('sqlite:../../db');
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $sq = $dbh->prepare('SELECT * FROM UC WHERE id=?;');
	$sq->execute([$uc]);
	if (!$sq->fetch()) {
		$_SESSION['msg'] = "UC does not exist! Please choose a valid one.";
		header('Location:/choiceUC/');
		die();
	}

	$sq = $dbh->prepare('SELECT * FROM StudentUCs WHERE uc = ? INTERSECT SELECT * FROM StudentUCs WHERE student = ?;');
	$sq->execute([$uc, $_SESSION['user_id']]);
	if(!$sq->fetch()){
		$_SESSION['msg'] = "Please choose an UC you are enrolled in!";
		header('Location:/choiceUC/');
		die();
	}

	$_SESSION['uc'] = $uc;
	header('Location:/solve-exercise/');
	die();
?>
