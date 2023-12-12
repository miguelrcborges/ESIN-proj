<?php
	session_start();

    $user = $_SESSION["user_id"];
    $uc = 101; //CHANGE LATER COM O TOMAS

	$question = $_POST['question'];
	$option1 = $_POST['option1'];
	$option2 = $_POST['option2'];
	$option3 = $_POST['option3'];
	$option4 = $_POST['option4'];
    
	//var_dump([$question, $option1, $option2, $option3, $option4, $user, $uc]);
    
    if ($option3 == NULL) {
        $option3 = NULL;
        $option4 = NULL;
    }
    elseif ($option4 == NULL) {
        $option4 = NULL;
    }


    if ($option1 == $option2) {
		$_SESSION['msg'] = "Two Options are the same";
		die();
	}

    $dbh = new PDO('sqlite:../../db');
	$sq = $dbh->prepare("INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) 
        VALUES ( ?, ?, ?, ?, ?, ?, ?);");
	$sq->execute([$question, $option1, $option2, $option3, $option4, $user, $uc]);


	$_SESSION['msg'] = "Question registered sucessfully";
	header('Location:/');
?>